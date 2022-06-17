<?php

namespace App\Enums;

enum SkillStatus: string
{

    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

}
