<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getKeyName()
    {
        return 'siswa_id';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }

    public function siswaList()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Nilai Pembagi
    public static function getDividerByCriteria($criterias)
    {
        $dividers = [];
        foreach ($criterias as $criteria) {
            if ($criteria->kategori === 'BENEFIT') {
                $divider = static::where('criteria_id', $criteria->id)->max('alternative_value');
            } else if ($criteria->kategori === 'COST') {
                $divider = static::where('criteria_id', $criteria->id)->min('alternative_value');
            }
            $data = [
                'criteria_id'   => $criteria->id,
                'nama_kriteria' => $criteria->nama_kriteria,
                'kategori'      => $criteria->kategori,
                'divider_value' => floatval($divider)
            ];
            array_push($dividers, $data);
        }
        return $dividers;
    }

    // get alternative
    public static function getAlternativesByCriteria($criterias)
    {
        $results = static::with('criteria', 'siswaList', 'kelas')->whereIn('criteria_id', $criterias)->get();
        if (!$results->count()) {
            return $results;
        }
        $finalRes = [];
        foreach ($results as $result) {
            $isExists = array_search($result->siswa_id, array_column($finalRes, 'siswa_id'));
            if ($isExists !== '' && $isExists !== null && $isExists !== false) {
                array_push($finalRes[$isExists]['criteria_id'], $result->criteria->id);
                array_push($finalRes[$isExists]['criteria_name'], $result->criteria->nama_kriteria);
                array_push($finalRes[$isExists]['alternative_val'], $result->alternative_value);
            } else {
                $data = [
                    'siswa_id'       => $result->siswa_id,
                    'siswa_name'     => $result->siswaList->nama_siswa,
                    'kelas_id'        => $result->kelas->id,
                    'kelas_name'      => $result->kelas->kelas_name,
                    'criteria_id'     => [$result->criteria->id],
                    'criteria_name'   => [$result->criteria->nama_kriteria],
                    'alternative_val' => [$result->alternative_value]
                ];
                array_push($finalRes, $data);
            }
        }
        return $finalRes;
    }

    public static function checkAlternativeByCriterias($criterias)
    {
        $isAllCriteriaPresent = false;
        foreach ($criterias as $criteria) {
            $check = static::where('criteria_id', $criteria)->get()->count();
            if ($check > 0) {
                $isAllCriteriaPresent = true;
            } else {
                $isAllCriteriaPresent = false;
                break;
            }
        }
        return $isAllCriteriaPresent;
    }
}