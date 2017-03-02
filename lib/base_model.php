<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }


    public function validate_password() {
        $errors = array();
        if ($this->password == '' || $this->password == null) {
            $errors[] = 'Salasana ei saa olla tyhjä!';
        }
        if (strlen($this->password) < 6) {
            $errors[] = 'Salasanan tulee olla vähintään 6 merkkiä pitkä.';
        }
        return $errors;
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();


        foreach ($this->validators as $validator) {
            $valid_errors = $this->{$validator}();
            $errors = array_merge($errors, $valid_errors);
        }

        return $errors;
    }

}
