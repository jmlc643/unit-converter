@extends('layouts.app')

@php
    $conversionType = session('conversionType', request('type', 'length'));
    
    $units = [
        'length' => [
            'meters' => 'Meters',
            'kilometers' => 'Kilometers', 
            'centimeters' => 'Centimeters',
            'millimeters' => 'Millimeters',
            'feet' => 'Feet',
            'inches' => 'Inches',
            'yards' => 'Yards',
            'miles' => 'Miles'
        ],
        'weight' => [
            'grams' => 'Grams',
            'kilograms' => 'Kilograms',
            'pounds' => 'Pounds',
            'ounces' => 'Ounces',
            'stones' => 'Stones',
            'tons' => 'Tons'
        ],
        'temperature' => [
            'celsius' => 'Celsius',
            'fahrenheit' => 'Fahrenheit',
            'kelvin' => 'Kelvin'
        ],
    ];
    
    $typeLabels = [
        'length' => 'Length',
        'weight' => 'Weight', 
        'temperature' => 'Temperature'
    ];
@endphp

@section('title', 'Unit Converter - Home')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Unit Converter</h1>
        <p class="text-gray-600">Convert between different units easily</p>
    </div>

    <!-- Navigation -->
    <nav class="mb-8">
        <ul class="flex justify-center space-x-6 bg-white rounded-lg shadow-sm p-4 flex-wrap">
            @foreach($typeLabels as $type => $label)
            <li class="mb-2 sm:mb-0">
                <a href="{{ route('converter.index', ['type' => $type]) }}" 
                   class="px-4 py-2 rounded-md font-medium transition-colors
                   {{ $conversionType === $type ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    {{ $label }}
                </a>
            </li>
            @endforeach
        </ul>
    </nav>

    <!-- Converter Form -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 text-center">
                {{ $typeLabels[$conversionType] }} Converter
            </h2>
        </div>

        <form action="{{ route('converter.convert') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="conversion_type" value="{{ $conversionType }}">
            
            <!-- Value Input -->
            <div>
                <label for="value" class="block text-sm font-medium text-gray-700 mb-2">
                    Enter the value to convert
                </label>
                <input type="number" 
                       id="value" 
                       name="value" 
                       step="any"
                       value="{{ session('lastValue', old('value')) }}"
                       required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter value">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- From Unit -->
                <div>
                    <label for="from_unit" class="block text-sm font-medium text-gray-700 mb-2">
                        From Unit
                    </label>
                    <select id="from_unit" 
                            name="from_unit" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select unit...</option>
                        @foreach($units[$conversionType] as $unit => $label)
                            <option value="{{ $unit }}" 
                                {{ session('lastFromUnit', old('from_unit')) === $unit ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- To Unit -->
                <div>
                    <label for="to_unit" class="block text-sm font-medium text-gray-700 mb-2">
                        To Unit
                    </label>
                    <select id="to_unit" 
                            name="to_unit" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select unit...</option>
                        @foreach($units[$conversionType] as $unit => $label)
                            <option value="{{ $unit }}"
                                {{ session('lastToUnit', old('to_unit')) === $unit ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Convert Button -->
            <div class="text-center">
                <button type="submit" 
                        class="px-8 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Convert {{ $typeLabels[$conversionType] }}
                </button>
            </div>
        </form>

        <!-- Result Display (if conversion result exists) -->
        @if(session('result'))
        <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-md">
            <h3 class="text-lg font-medium text-green-800 mb-2">Conversion Result:</h3>
            <p class="text-green-700 text-lg font-semibold">{{ session('result') }}</p>
        </div>
        @endif

        <!-- Error Display -->
        @if($errors->any())
        <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-md">
            <h3 class="text-lg font-medium text-red-800 mb-2">Errors:</h3>
            <ul class="text-red-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Quick Reference -->
        <div class="mt-8 p-4 bg-gray-50 rounded-md">
            <h3 class="text-lg font-medium text-gray-800 mb-2">Quick Reference:</h3>
            <div class="text-sm text-gray-600">
                @switch($conversionType)
                    @case('length')
                        <p><strong>Common conversions:</strong></p>
                        <ul class="list-disc list-inside mt-1">
                            <li>1 meter = 100 centimeters = 1000 millimeters</li>
                            <li>1 kilometer = 1000 meters</li>
                            <li>1 foot = 12 inches = 0.3048 meters</li>
                            <li>1 yard = 3 feet = 0.9144 meters</li>
                            <li>1 mile = 1609.34 meters</li>
                        </ul>
                        @break
                    @case('weight')
                        <p><strong>Common conversions:</strong></p>
                        <ul class="list-disc list-inside mt-1">
                            <li>1 kilogram = 1000 grams</li>
                            <li>1 pound = 453.592 grams</li>
                            <li>1 ounce = 28.3495 grams</li>
                            <li>1 stone = 6.35029 kilograms</li>
                            <li>1 ton = 1000 kilograms</li>
                        </ul>
                        @break
                    @case('temperature')
                        <p><strong>Temperature scales:</strong></p>
                        <ul class="list-disc list-inside mt-1">
                            <li>Water freezes: 0°C = 32°F = 273.15K</li>
                            <li>Water boils: 100°C = 212°F = 373.15K</li>
                            <li>Absolute zero: -273.15°C = -459.67°F = 0K</li>
                        </ul>
                        @break
                @endswitch
            </div>
        </div>
    </div>
</div>

<script>
// Auto-update form when switching conversion types to prevent mismatched units
document.addEventListener('DOMContentLoaded', function() {
    const conversionType = '{{ $conversionType }}';
    
    // Clear selections when conversion type changes if coming from a different type
    const urlParams = new URLSearchParams(window.location.search);
    const typeParam = urlParams.get('type');
    
    if (typeParam && typeParam !== '{{ session("conversionType", "length") }}') {
        // Clear form if switching types
        const valueInput = document.getElementById('value');
        const fromSelect = document.getElementById('from_unit');
        const toSelect = document.getElementById('to_unit');
        
        if (valueInput) valueInput.value = '';
        if (fromSelect) fromSelect.selectedIndex = 0;
        if (toSelect) toSelect.selectedIndex = 0;
    }
});
</script>
@endsection
