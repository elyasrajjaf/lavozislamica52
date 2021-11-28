<?php

$bdd = new PDO('mysql:host=localhost;dbname=lavozislamica;charset=utf8mb4', 'root', '');

// Hadith Books
$books= [
	'qudsi' 	    => 'Cuarenta hadices Qudsi.',
	'anawawi'   	=> 'Cuarenta hadices de an-Nawawi.',
	'ryad_asalihin'	=> 'Riyad as-Salihin.',
];

// Hadith narrators
$narrators= [
	'bukhari' 	    => 'Al-Bukhari',
	'muslim'   	    => 'Muslim',
	'an_nasai'	    => 'An-Nasa\'i',
	'abi_dawud'	    => 'Abi Dawud',
	'at_tirmidhi'	=> 'At-Tirmidhi',
	'ibn_majah'	    => 'Ibn Majah',
	'malik'	        => 'Malik',
	'ahmad'	        => 'Ahmad',
];

;?>

