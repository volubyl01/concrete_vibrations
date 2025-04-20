<?php
namespace App\Data;

class InstrumentSearchData
{
    public ?string $q = null; // Recherche texte
    public ?string $type_instr = null; // Type d’instrument
    public ?int $year_min = null;
    public ?int $year_max = null;
    public ?string $polyphony = null;
}