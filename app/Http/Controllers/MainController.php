<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Data;

class MainController extends Controller {
	public function storeItem(Request $request) {
		$data = new Data ();
		$data->name = $request->name;
		$data->age = $request->age;
		$data->profession = $request->profession;
		$data->save ();
		return $data;
	}
	public function readItems() {
		$data = Data::all ();
		return $data;
	}
	public function readItemscsv() {
		$headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=userprofession.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
		];

		$list = Data::all()->toArray();

		# add headers for each column in the CSV download
		array_unshift($list, array_keys($list[0]));

		$callback = function() use ($list) 
		{
			$FH = fopen('php://output', 'w');
			foreach ($list as $row) { 
				fputcsv($FH, $row);
			}
			fclose($FH);
		};
		return response()->stream($callback, 200, $headers);

	}
	public function deleteItem(Request $request) {
		$data = Data::find ( $request->id )->delete ();
	}
	public function editItem(Request $request, $id){
		$data =Data::where('id', $id)->first();
		$data->name = $request->get('val_1');
		$data->age = $request->get('val_2');
		$data->profession = $request->get('val_3');
		$data->save();
		return $data;
	}
}