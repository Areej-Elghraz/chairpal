<?php

namespace App\Services;

use App\Models\City;
use App\Models\Country;

class GeoService
{
    /**
     * Get or create a country and city.
     */
    public function getOrCreateGeoData(string $countryName, string $cityName): array
    {
        $country = Country::firstOrCreate(['name' => strtolower($countryName)]);

        $city = City::firstOrCreate([
            'name'       => strtolower($cityName),
            'country_id' => $country->id,
        ]);

        return [
            'country_id' => $country->id,
            'city_id'    => $city->id,
        ];
    }
    /**
     * Get a country.
     */
    public function getCountry(?int $countryId = null, ?string $countryName = null): ?Country
    {
        if ($countryId) {
            return Country::find($countryId);
        }

        if ($countryName) {
            return Country::where('name', strtolower($countryName))->first();
        }

        return null;
    }
    /**
     * Get a city.
     */
    public function getCity(?int $cityId = null, ?string $cityName = null): ?City
    {
        if ($cityId) {
            return City::find($cityId);
        }

        if ($cityName) {
            return City::where('name', strtolower($cityName))->first();
        }

        return null;
    }
}
