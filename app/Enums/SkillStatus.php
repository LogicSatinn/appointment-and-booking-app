<?php

namespace App\Enums;

enum SkillStatus: string
{
    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';
    case ARCHIVED = 'Archived';

}
