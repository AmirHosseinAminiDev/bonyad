<?php

if (!function_exists('documentService')) {
    /**
     * Get an instance of the DocumentService service class.
     *
     * @return \App\Services\DocumentService
     */
    function documentService()
    {
        return app(\App\Services\DocumentService::class);
    }
}
