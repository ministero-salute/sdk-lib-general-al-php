<?php
namespace AccessLayerMdS\Model
{
    abstract class BaseResponse
    {
        public bool $success;
        public string $message;
    }
}