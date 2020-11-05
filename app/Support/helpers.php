<?php



if (! function_exists('convert_input_to_dot_separated_array')) {
	/**
	 * Function for converting input to dot separated array
	 */
	function convert_input_to_dot_separated_array ($inputName) {
		$inputParts = explode('[', $inputName);
		if (count($inputParts) == 1) {
			return $inputParts[0];
		}
		$firstName = $inputParts[0];
		preg_match_all('/\[(.*?)\]/', $inputName, $matches);
		if (!isset($matches[1])) {
			return $inputName;
		}
		return $firstName . '.' . implode('.', $matches[1]);
	}
}

if (! function_exists('toastr')) {
	/**
	 * Function for flashing message to jquery toastr listener
	 *
	 * @param $data - array of data that will be passed to the toastr
	 * @param $url (optional) - If set, function will redirect to this path after flashing data
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	function toastr($data, $url = false) {
		session()->flash('toastr' ,$data);
		if($url)
			return redirect($url)->send();
	}
}
