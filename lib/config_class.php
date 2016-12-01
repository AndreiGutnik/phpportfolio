<?php

abstract class Config {

	const SITENAME = "PHPPortfolio";
	const SECRET = "DGLJDG5";
	const ADDRESS = "http://phpportfolio";
	const ADM_NAME = "Андрей Гутник";
	const ADM_EMAIL = "andreigutnik@gmail.com";
	
	const API_KEY = "DKEL39DL";
	
	const DB_HOST = "localhost";
	const DB_USER = "andrei";
	const DB_PASSWORD = "203523";
	const DB_NAME = "portfolio";
	const DB_PREFIX = "xyz_";
	const DB_SYM_QUERY = "?";
	
	const DIR_IMG = "/images/";
	const DIR_IMG_ARTICLES = "/images/articles/";
	const DIR_AVATAR = "/images/avatars/";
	const DIR_TMPL = "D:/www/site/phpportfolio/tmpl/";
	const DIR_EMAILS = "D:/www/site/phpportfolio/tmpl/emails/";
	
	const LAYOUT = "main";
	const FILE_MESSAGES = "D:/www/site/phpportfolio/text/messages.ini";
	
	const FORMAT_DATE = "%d.%m.%Y %H:%M:%S";
	
	const COUNT_ARTICLES_ON_PAGE = 3;
	const COUNT_SHOW_PAGES = 10;
	
	const MIN_SEARCH_LEN = 3;
	const LEN_SEARCH_RES = 255;
	
	const SEF_SUFFIX = ".html";
	
	const DEFAULT_AVATAR = "default.png";
	const MAX_SIZE_AVATAR = 51200;
}

?>