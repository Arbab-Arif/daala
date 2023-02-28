<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ItemImport implements ToModel, WithStartRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model(array $row)
    {
        $category = Category::query()->firstOrCreate([
            'name' => $row[1]
        ]);

        $data = [];
        $data[] = [$row[4], $row[5], $row[6], $row[7], $row[8]];
        $data[] = [$row[9], $row[10], $row[11], $row[12], $row[13]];
        $data[] = [$row[14], $row[15], $row[16], $row[17], $row[18]];
        $sizeCharts = collect($data)
            ->filter(
                fn($sizeChart) => collect($sizeChart)
                    ->every(fn($value) => $value !== '' && $value !== null)
            )
            ->map(fn($sizeChart) => [
                'label'  => $sizeChart[0],
                'weight' => $sizeChart[1],
                'width'  => $sizeChart[2],
                'height' => $sizeChart[3],
                'breath' => $sizeChart[4]
            ]);

        $item = Item::create([
            'category_id' => $category->id,
            'name'        => $row[0],
            'unit'        => $row[2],
            'description' => $row[3],
        ]);

        $item->sizeChart()->createMany($sizeCharts->toArray());

    }

    public function startRow(): int
    {
        return 3;
    }

}
