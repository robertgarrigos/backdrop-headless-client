<?php

namespace Robertgarrigos\BackdropHeadlessClient;

use stdClass;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\RequestException;

class BackdropHeadlessClient
{
    protected $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * Get a view
     *
     * @param String $view view's machine name
     * @param String $display_id view's display_id
     * @param String $args any additional arguments
     **/
    public function getView($view, $display_id, $args = null)
    {
        $url = config('backdrop-headless-client.backdrop_api_server') . '/api/v2/views/' . $view . '/' . $display_id . '/' . $args;
        try {
            $response = $this->client->get($url);
        } catch (RequestException $e) {
            abort(404);
        }
        $view = json_decode($response->getBody()->getContents());
        if (isset($view->code) && $view->code == 404) {
            abort(404);
        }
        $view = collect($view);

        return $view;
    }

    /**
     * Get a mapped node
     *
     * @param String $type type of node
     * @param Int $id id of node
     **/
    public function getNode($type, $id)
    {
        $url = config('backdrop-headless-client.backdrop_api_server')
            . '/api/v2/node/'
            . $type
            . '/' . $id;
        try {
            $response = $this->client->get($url);
        } catch (RequestException $e) {
            abort(404);
        }
        $node = json_decode($response->getBody()->getContents());
        if (null != config('backdrop-headless-client.node_types.' . $type)) {
            $mapped_node = $this->mapToNode($type, $node);
        }
        else {
            $mapped_node = $node;
        }

        return $mapped_node;
    }

    /**
     * Get a term object
     *
     * @param String $vocabulary term's vocabulary
     * @param Int $id term's id
     **/
    public function getTerm($vocabulary, $id)
    {
        $url = config('backdrop-headless-client.backdrop_api_server')
            . '/api/'
            . $vocabulary
            . '/term/' . $id;
        $response = $this->client->get($url);
        $term = json_decode($response->getBody()->getContents());
        if (!$term) {
            abort(404);
        }

        return $term;
    }

    /**
     * Map backdrop node to the configured fields
     *
     * @param String $type Type of node
     * @param Object $node node to map
     * @return object
     **/
    public function mapToNode($type, $node)
    {
        $node_types = config('backdrop-headless-client.node_types');
        $mapped_node = new stdClass();
        if (isset($node_types[$type])) {
            foreach ($node_types[$type] as $field => $value) {
                if ($value['type'] == 'single') {
                    $p = implode('.', $value['properties']);
                    $mapped_node->$field = data_get($node, $p);
                }
                if ($value['type'] == 'multiple') {
                    $a = data_get($node, implode('.', $value['properties']));
                    if (is_array($a)) {
                        foreach ($a as $k => $v) {
                            $a2 = array_merge($value['properties'],array($k),$value['value']);
                            $mapped_node->$field[] = data_get($node, $a2);
                        }
                    }

                }
            }
        }

        return $mapped_node;
    }

    /**
     * Get a paragraphs item
     *
     * @param String $view view's machine name
     * @param String $display_id view's display_id
     * @param String $args any additional arguments
     * @return json
     **/
    public function getParagraph($type, $id)
    {
        $url = config('backdrop-headless-client.backdrop_api_server') . '/api/v2/paragraphs/' . $type . '/' . $id;
        try {
            $response = $this->client->get($url);
        } catch (RequestException $e) {
            abort(404);
        }
        $paragraph = json_decode($response->getBody()->getContents());
        if (isset($paragraph->code) && $paragraph->code == 404) {
            abort(404);
        }

        return $paragraph;
    }

}
