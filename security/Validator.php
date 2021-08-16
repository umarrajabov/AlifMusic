<?php

namespace security;

class Validator
{
    private array $data;
    public array $files;
    public array $errors = [];

    public function __construct($data, $files = [])
    {
        $this->data = $data;
        $this->files = $files;
    }

    public function validate(...$actions): array
    {
        foreach ($actions as $value) {
            if (in_array('required', $value)) {
                switch ($value[1]) {
                    case 'username':
                        $this->validateUsername();
                        break;
                    case 'password':
                        $this->validatePassword();
                        break;
                    case 'email':
                        $this->validateEmail();
                        break;
                    case 'number':
                        $this->validateNumber($value[0]);
                        break;
                    case 'string':
                        $this->validateString($value[0]);
                        break;
                    case 'image':
                        $this->validateImage();
                        break;
                    case 'music':
                        $this->validateMusic();
                        break;
                }
            }
        }
        return $this->errors;
    }


    private function validateUsername(): void
    {
        if ($value = $this->required('username')) {
            if (!preg_match('/^[a-zA-Z0-9]{4,12}$/', $value)) {
                $this->addError('username', 'username must be 4-12 chars and alphanumeric');
            }
        }
    }

    private function validatePassword(): void
    {
        if ($value = $this->required('password')) {
            if (!preg_match('/^[a-zA-Z0-9]{4,12}$/', $value)) {
                $this->addError('password', 'password must be 4-12 chars and alphanumeric');
            }
        }
    }

    private function validateEmail(): void
    {
        if ($value = $this->required('email')) {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Email must be a valid email');
            }
        }
    }

    /**
     * @param string
     */
    private function validateNumber(string $key): void
    {
        if ($value = $this->required($key)) {
            if (!(int)preg_match('/^[0-9]+$/', $value)) {
                $this->addError($key, "$key must be numeric");
            }
        }
    }

    public function validateString($key)
    {
        if ($value = $this->required($key)) {
            if (preg_match('/^[0-9]+$/', $value)) {
                $this->addError($key, 'Поля должень содержить только букви');
            }
        }
    }

    private function required($key)
    {
        $value = trim(htmlspecialchars($this->data[$key]));
        if (empty($value)) {
            $this->addError($key, "$key cannot be empty");
            return false;
        }
        return $value;
    }

    private function validateImage()
    {
        $types = ['image/jfif', 'image/png', 'image/jpg', 'image/jpeg'];
        $fileType = $this->files['image']['type'];

        if (!in_array($fileType, $types)) {
            $this->addError('image', 'Image format not supported!');
        }
    }

    private function validateMusic()
    {
        $types = ['audio/mpeg', 'audio/mp3', 'audio/ogg'];
        $fileType = $this->files['music']['type'];

        if (!in_array($fileType, $types)) {
            $this->addError('music', 'Music format not supported!');
        }
    }

    private function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }
}
