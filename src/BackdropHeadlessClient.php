<?php

namespace Robertgarrigos\BackdropHeadlessClient;

use Illuminate\Support\Facades\Http;
use stdClass;

class BackdropHeadlessClient
{
    /**
     * Get a view
     *
     * @param String $view view's machine name
     * @param String $display_id view's display_id
     * @param String $args any additional arguments
     **/
    public function getView($view, $display_id, $args = null)
    {
        // TODO: check for trailing slash??
        $url = config('backdrop-headless-client.backdrop_api_server')
            . '/api/v2/views/'
            . $view . '/'
            . $display_id . '/'
            . $args;

        $response = Http::get($url)->throw();


        $view = $response->json();

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
        $response = Http::get($url)->throw();

        $node = $response->json();

        if (config('backdrop-headless-client.node_types.' . $type) != null) {
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
        $response = Http::get($url)->throw();

        $term = $response->json();

        return $term;
    }

    /**
     * Get a paragraphs item
     *
     * @param String $view view's machine name
     * @param String $display_id view's display_id
     * @param String $args any additional arguments
     **/
    public function getParagraph($type, $id)
    {
        $url = config('backdrop-headless-client.backdrop_api_server') .
            '/api/v2/paragraphs/' .
            $type . '/' .
            $id;
        $response = Http::get($url)->throw();

        $paragraph = $response->json();

        return $paragraph;
    }

    /**
     * Get a block item
     *
     * @param String $view view's machine name
     * @param String $display_id view's display_id
     * @param String $args any additional arguments
     **/
    public function getBlock($name)
    {
        $url = config('backdrop-headless-client.backdrop_api_server') .
            '/api/blocks/' .
            $name;

        $response = Http::get($url)->throw();

        $block = $response->json();

        return $block;
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

}
