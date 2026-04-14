<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use App\Models\Verse;
use GuzzleHttp\Client;

class SurahController extends Controller
{
    public function surah()
    {
        return response()->json(['data' => Surah::all()]);
    }

    public function surahGetId($id)
    {
        return response()->json(['data' => Verse::where('surah_id', $id)->get()]);
    }

    public function verses()
    {
        $client = new Client(['verify' => false]);
        $sura = Surah::where('number', '>', 10)->select('number', 'total_verses')->get();
        foreach ($sura as $s) {
            $surah_id = $s->number;
            $total = $s->total_verses;
            for ($index = 1; $index <= $total; $index++) {
                $url = "https://apis.quran.foundation/content/api/v4/verses/by_key/$surah_id:$index?translations=45&language=ru&fields=text_uthmani&per_page=10&words=true";
                $res = $client->request('GET', $url, [
                    'headers' => [
                        'x-auth-token' => 'eyJhbGciOiJSUzI1NiIsImtpZCI6ImY5MzAxZjgwLTdkY2QtNGNkMi04NWZlLTJjNWM5NjBhYTA2OSIsInR5cCI6IkpXVCJ9.eyJhdWQiOltdLCJjbGllbnRfaWQiOiIwMGU5ZjBkMy1iYTNlLTQyOGYtOWE2Zi01M2M3MTQ2OGIyMGEiLCJleHAiOjE3NzU2ODA3NjAsImV4dCI6e30sImlhdCI6MTc3NTY3NzE2MCwiaXNzIjoiaHR0cHM6Ly9vYXV0aDIucXVyYW4uZm91bmRhdGlvbiIsImp0aSI6IjUzZDgzNjQ3LTZjMzQtNDc0NC05MTJiLTg0YjZiYWRkYjk3NiIsIm5iZiI6MTc3NTY3NzE2MCwic2NwIjpbImNvbnRlbnQiXSwic3ViIjoiMDBlOWYwZDMtYmEzZS00MjhmLTlhNmYtNTNjNzE0NjhiMjBhIn0.A-92KZSF4GscdVxUw_yFr1gTBoTh7gZojxeSN7vnuJeLqVVCotMA3T7Y0bksHuRf6fRJJB6QOASe6U7EZYTXLDZnDY5NBawQHZxYkrirsoN5zrxHaK6peplUEctgPz1yD05X53ftQnCJnt6XuzS4E6cUxrvVIhJxZ2gL6_7EJpWizczFmTIqC8V-S1NGEBas_SzCy3I41gWayurE_pm2QngFWo7AGTAJIw8m_eEWVFMwy4AJdG8EF-M28LHyFB8RUCs7mkHRC7Fc6LxbJp-YmfwMMWW75DTFaNrFw5CKhgJsHw83MuoMgW9d3IHDvQP6kA78mHSPj24pE2lf3OenCQ9u4AZRuH5CHg0YesZX45i2qa_py3D3ILC-NTjZOQFIRCvHOYfFCkBanA4Kx3pClaev88YopLjlXjmC1x_RCoRIaa8kxPltDgNXY5ereC5KR7vMUq6QHQLkDkFVgdo0e-0UBHVTUCd00azwIzE4QpYHvf5WWGf9hPNWHnkfDunYStC8L2D7mh_zQTqyH7llpRiVtESi5jdyEIg3fH7XbfhElMc7sCYWFWn3oGuiu0zL7bGwVBsXxKhbkRgpzasYb7mXwGeZeEMqQNoBbanzxTBhkuTwj9PTe5d7NAqQT0S-KK_wmtI1OJC3Tk02vQD5ziFgpNF86A7Dl4bbzCF6QdA',
                        'x-client-id' => '00e9f0d3-ba3e-428f-9a6f-53c71468b20a'
                    ]
                ]);
                $resp = $res->getBody()->getContents();
                $resp = json_decode($resp, true);
                $arabic = $resp['verse']['text_uthmani'];
                $ru = $resp['verse']['translations'][0]['text'];
                Verse::create([
                    'surah_id' => $surah_id,
                    'verse_number' => $index,
                    'text_ar' => $arabic,
                    'text_ru' => $ru,
                ]);
            }
        }
    }
}
