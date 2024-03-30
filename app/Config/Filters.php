<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'filterAdmin' => \App\Filters\FilterAdmin::class,
		'filterPengasuhan' => \App\Filters\FilterPengasuhan::class,
		'filterMusrif' => \App\Filters\FilterMusrif::class
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			// 'csrf',
			'filterAdmin' => [
				'except' => ['login/*', 'login', '/']
			],
			'filterPengasuhan' => [
				'except' => ['login/*', 'login', '/']
			],
			'filterMusrif' => [
				'except' => ['login/*', 'login', '/']
			]
			
		],
		'after'  => [
			'toolbar',
			// 'honeypot',
			'filterAdmin' => [
				'except' => ['layout/*', 'perizinan/*', 'santri/*', 'kelas/*', 'musrif/*' ,'kamar/*', 'priode/*', 'laporan/*', 'users/*', 'setting/*', 'karpel/*', 'absen/*', 'utility/*']
			],
			'filterPengasuhan' => [
				'except' => ['layout/*', 'perizinan/*', 'santri/*', 'kelas/*', 'musrif/*' ,'kamar/*', 'priode/*', 'laporan/*', 'utility/*', 'absen/*']
			],
			'filterMusrif' => [
				'except' => ['layout/*', 'absen/*', 'utility/*', 'sakit/*','laporan/*']
			]
			
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
