<?php

interface IPostValidator {


	public function isTitleValid($title);

	public function isUsernameValid($username);

	public function isTextValid($text);
}