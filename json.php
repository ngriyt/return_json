<?php 

$arr = [
	'contacts' => [
		'address' => 'Машиностроительная, 91',
		'num_phone' => '8003003080',
		'key_phone' => '+7',
		'site' => 'chelny.ru',
	],
	'info' => [
		'residents' => [
			'Руслан' => [
				'age' => 16,
				'bd' => '14.01.2002'
			],
			'Максим' => [
				'age' => 18,
				'bd' => '01.02.2001'
			],
			'Александр' => [
				'age' => 20,
				'bd' => '06.03.1999'
			],
		],
		'text' => 'IT-Park - технопарк в области информационно-коммуникационных технологий, созданный на территории Республики Татарстан в рамках Комплексной программы «Создание в Российской Федерации технопарков в сфере высоких технологий»'
	]
];

echo json_encode($arr, JSON_UNESCAPED_UNICODE);

?>
