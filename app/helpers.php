<?php
function encodestrings($string)
{
    $starr= array(
        "а"=>"a", "б"=>"b", "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo",
        "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"i", "к"=>"k", "л"=>"l", "м"=>"m",
        "н"=>"n", "о"=>"o", "п"=>"p", "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u",
        "ф"=>"f", "х"=>"kh", "ц"=>"c", "ч"=>"ch", "ш"=>"sh", "щ"=>"sh", "ъ"=>"i",
        "ы"=>"y", "ь"=>"i", "э"=>"e", "ю"=>"yu", "я"=>"ya", "А"=>"A", "Б"=>"B",
        "В"=>"V", "Г"=>"G", "Д"=>"D", "Е"=>"E", "Ё"=>"YO", "Ж"=>"ZH", "З"=>"Z",
        "И"=>"I", "Й"=>"I", "К"=>"K", "Л"=>"L", "М"=>"M", "Н"=>"N", "О"=>"O",
        "П"=>"P", "Р"=>"R", "С"=>"S", "Т"=>"T", "У"=>"U", "Ф"=>"F", "Х"=>"KH",
        "Ц"=>"C", "Ч"=>"CH", "Ш"=>"SH", "Щ"=>"SH", "Ъ"=>"I", "Ы"=>"Y", "Ь"=>"I",
        "Э"=>"E", "Ю"=>"YU", "Я"=>"YA", " "=>"_", "("=>"_", ")"=>"_","."=>"_",",
        "=>"_","-"=>"_m_","+"=>"_p_","%"=>"",'"'=>'',"'"=>'',"/"=>"-","="=>"","№"=>"nr");
    $st=strtr($string,$starr);
        // Возвращаем результат.
    return $st;
}
?>
