<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Tag\TagRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Str;
use Exception;

class TagService extends BaseService
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function all()
    {
        return $this->tagRepository->all();
    }

    public function index($params)
    {
        return $this->tagRepository->index($params);
    }

    public function syncTag($tags)
    {
        $tagsId = [];
        foreach ($tags as $tag) {
            if (is_numeric($tag) && !in_array((int)$tag, $tagsId)) {
                $tagsId[] = (int)$tag;
            } else {
                $tagSlug = Str::slug($tag, '-');
                $tagExist = $this->tagRepository->getTagBySlug($tagSlug);
                if (!empty($tagExist->id)) {
                    if (!in_array((int)$tagExist->id, $tagsId)) {
                        $tagsId[] = (int)$tagExist->id;
                    }

                } else {
                    //add tag
                    $newTag = $this->tagRepository->create([
                        'label' => $tag,
                        'slug' => $tagSlug,
                    ]);
                    if (!empty($newTag->id)) {
                        $tagsId[] = $newTag->id;
                    }
                }
            }
        }
        return $tagsId;
    }

    public function getCountSlugLikeName($slug, $id = null)
    {
        return $this->tagRepository->getCountSlugLikeName($slug, $id);
    }

    public function store($attributes)
    {
        return $this->tagRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->tagRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->tagRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->tagRepository->delete($id);
    }
}
