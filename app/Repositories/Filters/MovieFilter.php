<?php


namespace App\Repositories\Filters;


use App\Base\Repository\BaseFilter;
use App\Base\Service\Q;
use Illuminate\Database\Eloquent\Builder;

class MovieFilter extends BaseFilter
{
    public function apply(Q $query): Builder {
        $builder = $this->builder;
        foreach ($query->filter as $key => $value) {
            // пустые значения не участвуют в поиске
            if(empty($value))
                continue;

            switch ($key) {
                case 'name':
                    $exact = isset($filter['name_exact']) && $filter['name_exact'];
                    if($exact)
                        $builder->where('movies.name', '=', $value);
                    else
                        $builder->where('movies.name', 'like', '%'.$value.'%');
                    break;
                case 'genreId':
                    $builder
                        ->join('movie_genre', 'movies.id', '=', 'movie_genre.genre_id');
                    if(is_array($value))
                        $builder->whereIn('movie_genre.genre_id', $value);
                    else
                        $builder->where('movie_genre.genre_id', ' in ', $value);
                    break;
                case 'countryId':
                    break;
            }
        }

        return $builder;
    }
}
