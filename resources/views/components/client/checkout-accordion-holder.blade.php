<div class="border rounded shadow mb-6 overflow-hidden">
    <div class="d-flex align-items-center" id="curriculumheadingOne">
        <h5 class="mb-0 w-100">
            <button class="d-flex align-items-center p-5 min-height-80 text-dark fw-medium collapse-accordion-toggle line-height-one" type="button" data-bs-toggle="collapse" data-bs-target="#CurriculumcollapseOne" aria-expanded="true" aria-controls="CurriculumcollapseOne">
                                        <span class="me-4 text-dark d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="2" viewBox="0 0 15 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="15" height="2" fill="currentColor"/>
                                            </svg>

                                            <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0 7H15V9H0V7Z" fill="currentColor"/>
                                                <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"/>
                                            </svg>

                                        </span>
{{--                Client Details--}}
                {{ $accordionTitle }}
            </button>
        </h5>
    </div>

    <div id="CurriculumcollapseOne" class="collapse show" aria-labelledby="curriculumheadingOne" data-parent="#accordionCurriculum">
            {{ $column }}
    </div>
</div>
