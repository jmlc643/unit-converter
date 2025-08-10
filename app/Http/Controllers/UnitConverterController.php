<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitConverterController extends Controller
{
    public function index(Request $request)
    {
        $conversionType = $request->get('type', 'length');
        
        return view('index', compact('conversionType'));
    }

    public function convert(Request $request)
    {
        $request->validate([
            'value' => 'required|numeric',
            'from_unit' => 'required|string',
            'to_unit' => 'required|string',
            'conversion_type' => 'required|string|in:length,weight,temperature'
        ]);

        $value = $request->value;
        $fromUnit = $request->from_unit;
        $toUnit = $request->to_unit;
        $conversionType = $request->conversion_type;

        $result = $this->performConversion($value, $fromUnit, $toUnit, $conversionType);

        return redirect()->back()
            ->with('result', $result)
            ->with('conversionType', $conversionType)
            ->with('lastValue', $value)
            ->with('lastFromUnit', $fromUnit)
            ->with('lastToUnit', $toUnit);
    }

    private function performConversion($value, $fromUnit, $toUnit, $type)
    {
        switch ($type) {
            case 'length':
                return $this->convertLength($value, $fromUnit, $toUnit);
            case 'weight':
                return $this->convertWeight($value, $fromUnit, $toUnit);
            case 'temperature':
                return $this->convertTemperature($value, $fromUnit, $toUnit);
            default:
                return "Invalid conversion type";
        }
    }

    private function convertLength($value, $fromUnit, $toUnit)
    {
        // Convertir todo a metros primero
        $valueInMeters = $this->toMeters($value, $fromUnit);
        
        // Convertir de metros a la unidad destino
        $result = $this->fromMeters($valueInMeters, $toUnit);
        
        return "{$value} {$fromUnit} = {$result} {$toUnit}";
    }

    private function toMeters($value, $unit)
    {
        $conversions = [
            'meters' => 1,
            'kilometers' => 1000,
            'centimeters' => 0.01,
            'millimeters' => 0.001,
            'feet' => 0.3048,
            'inches' => 0.0254,
            'yards' => 0.9144,
            'miles' => 1609.34
        ];

        return $value * $conversions[$unit];
    }

    private function fromMeters($value, $unit)
    {
        $conversions = [
            'meters' => 1,
            'kilometers' => 1000,
            'centimeters' => 0.01,
            'millimeters' => 0.001,
            'feet' => 0.3048,
            'inches' => 0.0254,
            'yards' => 0.9144,
            'miles' => 1609.34
        ];

        return round($value / $conversions[$unit], 6);
    }

    private function convertWeight($value, $fromUnit, $toUnit)
    {
        // Convertir todo a gramos primero
        $valueInGrams = $this->toGrams($value, $fromUnit);
        
        // Convertir de gramos a la unidad destino
        $result = $this->fromGrams($valueInGrams, $toUnit);
        
        return "{$value} {$fromUnit} = {$result} {$toUnit}";
    }

    private function toGrams($value, $unit)
    {
        $conversions = [
            'grams' => 1,
            'kilograms' => 1000,
            'pounds' => 453.592,
            'ounces' => 28.3495,
            'stones' => 6350.29,
            'tons' => 1000000
        ];

        return $value * $conversions[$unit];
    }

    private function fromGrams($value, $unit)
    {
        $conversions = [
            'grams' => 1,
            'kilograms' => 1000,
            'pounds' => 453.592,
            'ounces' => 28.3495,
            'stones' => 6350.29,
            'tons' => 1000000
        ];

        return round($value / $conversions[$unit], 6);
    }

    private function convertTemperature($value, $fromUnit, $toUnit)
    {
        // Convertir todo a Celsius primero
        $valueInCelsius = $this->toCelsius($value, $fromUnit);
        
        // Convertir de Celsius a la unidad destino
        $result = $this->fromCelsius($valueInCelsius, $toUnit);
        
        return "{$value}° {$fromUnit} = {$result}° {$toUnit}";
    }

    private function toCelsius($value, $unit)
    {
        switch ($unit) {
            case 'celsius':
                return $value;
            case 'fahrenheit':
                return ($value - 32) * 5/9;
            case 'kelvin':
                return $value - 273.15;
            default:
                return $value;
        }
    }

    private function fromCelsius($value, $unit)
    {
        switch ($unit) {
            case 'celsius':
                return round($value, 2);
            case 'fahrenheit':
                return round(($value * 9/5) + 32, 2);
            case 'kelvin':
                return round($value + 273.15, 2);
            default:
                return round($value, 2);
        }
    }
}
