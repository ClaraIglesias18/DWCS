<?php
    class Usuario {
        public function __construct(protected $id_usuario = null, protected $nombre = null, protected $correo = null, protected $password = null, protected $rol = 0,  $encriptar = false) {
            
            if($encriptar) {
                $this->password = password_hash($password, PASSWORD_DEFAULT);
            }

        }

        public function validarUsuario($correo, $password) {
            return password_verify($password, $this->password) && $correo == $this->correo;
        }
        /**
         * Get the value of id_usuario
         */
        public function getIdUsuario()
        {
                return $this->id_usuario;
        }

        /**
         * Set the value of id_usuario
         */
        public function setIdUsuario($id_usuario): self
        {
                $this->id_usuario = $id_usuario;

                return $this;
        }

        /**
         * Get the value of nombre
         */
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         */
        public function setNombre($nombre): self
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of correo
         */
        public function getCorreo()
        {
                return $this->correo;
        }

        /**
         * Set the value of correo
         */
        public function setCorreo($correo): self
        {
                $this->correo = $correo;

                return $this;
        }

        /**
         * Get the value of password
         */
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         */
        public function setPassword($password): self
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of rol
         */
        public function getRol()
        {
                return $this->rol;
        }

        /**
         * Set the value of rol
         */
        public function setRol($rol): self
        {
                $this->rol = $rol;

                return $this;
        }
    }