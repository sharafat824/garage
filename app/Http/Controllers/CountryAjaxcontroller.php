<?php

namespace App\Http\Controllers;

use App\Setting;
use DB;
use Illuminate\Http\Request;

class CountryAjaxcontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//get state
	public function getstate(Request $request)
	{
		//$id = Input::get('countryid');
		$id = $request->countryid;
		$setting = Setting::first();

		$states = DB::table('tbl_states')->where('country_id', '=', $id)->get()->toArray();
		if (!empty($states)) {
			echo '<option value="">Select State</option>';
			foreach ($states as $statess) {
				// Check if the state is selected based on the setting
				$selected = ($setting && $statess->id == $setting->state_id) ? 'selected' : '';

				echo '<option value="' . $statess->id . '" class="states_of_countrys" ' . $selected . '>';
				echo $statess->name;
				echo '</option>';
			}
		}
	}

	//get city
	public function getcity(Request $request)
	{
		//$stateid = Input::get('stateid');
		$stateid = $request->stateid;
		$setting = Setting::first();
	//	dd($setting->city_id);
		$cities = DB::table('tbl_cities')->where('state_id', '=', $stateid)->get()->toArray();
		if (!empty($cities)) {
			$response = '<option value="">Select City</option>';
			foreach ($cities as $city) {
				// Check if the city matches the saved city ID in settings
				$selected = ($setting && $city->id == $setting->city_id) ? 'selected' : '';

				// Append the option to the response with selected attribute if applicable
				$response .= '<option value="' . $city->id . '" class="cities" ' . $selected . '>' . $city->name . '</option>';
			}
			return response($response);
		}
	}
}
