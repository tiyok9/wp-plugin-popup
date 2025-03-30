<?php

namespace app\request;

class Validation
{
	protected function validate($data, $rules)
	{
		$errors = [];
		$validatedData = [];

		foreach ($rules as $field => $ruleList) {
			if (!isset($data[$field])) {
				// Jika required tapi tidak ada di data, tambahkan error
				if (in_array('required', $ruleList)) {
					$errors[$field][] = "Field $field is required.";
				}
				continue;
			}

			$value = $data[$field];

			// Jika field berupa array (contoh: checkbox dengan multiple value seperti page_ids[])
			if (is_array($value)) {
				foreach ($value as $key => $item) {
					foreach ($ruleList as $rule) {
						$this->applyRule($errors, $validatedData, $field, $key, $item, $rule);
					}
				}
			} else {
				// Jika field bukan array, langsung validasi
				foreach ($ruleList as $rule) {
					$this->applyRule($errors, $validatedData, $field, null, $value, $rule);
				}
			}
		}

		return ['errors' => $errors, 'validated' => $validatedData];
	}

	private function applyRule(&$errors, &$validatedData, $field, $key, $value, $rule)
	{
		if ($rule === 'required' && trim($value) === '' && $value !== '0') {
			$errors[$field][$key ?? 0] = "Field $field is required.";
		}
		if ($rule === 'numeric' && !is_numeric($value)) {
			$errors[$field][$key ?? 0] = "Field $field must be numeric.";
		}
		if (preg_match('/min:(\d+)/', $rule, $matches)) {
			if ($value < $matches[1]) {
				$errors[$field][$key ?? 0] = "Field $field must be at least {$matches[1]}.";
			}
		}
		if (preg_match('/max:(\d+)/', $rule, $matches)) {
			if ($value > $matches[1]) {
				$errors[$field][$key ?? 0] = "Field $field must be at most {$matches[1]}.";
			}
		}

		// Jika tidak ada error, tambahkan ke validatedData
		if (!isset($errors[$field][$key ?? 0])) {
			if ($key !== null) {
				$validatedData[$field][$key] = $value;
			} else {
				$validatedData[$field] = $value;
			}
		}
	}


}
