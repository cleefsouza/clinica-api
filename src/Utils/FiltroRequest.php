<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class FiltroRequest
 * @package App\Utils
 */
class FiltroRequest
{
    /**
     * @param Request $request
     * @return array|null
     */
    private function getDadosUrl(Request $request): ?array
    {
        $filtros = $request->query->all();

        $order = array_key_exists("order", $filtros) ? $filtros["order"] : null;
        unset($filtros["order"]);

        $page = array_key_exists("page", $filtros) ? $filtros["page"] : 1;
        unset($filtros["page"]);

        $limit = array_key_exists("limit", $filtros) ? $filtros["limit"] : 5;
        unset($filtros["limit"]);

        return [$order, $filtros, $page, $limit];
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function getOrder(Request $request): ?array
    {
        [$order, ] = $this->getDadosUrl($request);

        return $order;
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function getFiltros(Request $request): ?array
    {
        [, $filtros] = $this->getDadosUrl($request);

        return $filtros;
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function getPages(Request $request): ?array
    {
        [, , $page, $limit] = $this->getDadosUrl($request);
        $offset = ($page - 1) * $limit;

        return [$limit, $offset];
    }
}
