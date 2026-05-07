<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;
use App\Services\OrganizationService;
use App\Services\PlaceService;
use App\Models\Category;
use App\Models\Organization;

class CreateMainEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-main {type : The type of entity to create (category, organization, place)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a main entity (Category, Organization, or Place) with a null owner.';

    protected $categoryService;
    protected $organizationService;
    protected $placeService;

    public function __construct(
        CategoryService $categoryService,
        OrganizationService $organizationService,
        PlaceService $placeService
        )
    {
        parent::__construct();
        $this->categoryService = $categoryService;
        $this->organizationService = $organizationService;
        $this->placeService = $placeService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = strtolower($this->argument('type'));

        switch ($type) {
            case 'category':
                $this->createCategory();
                break;
            case 'organization':
                $this->createOrganization();
                break;
            case 'place':
                $this->createPlace();
                break;
            default:
                $this->error("Invalid type. Supported types: category, organization, place.");
                break;
        }
    }

    protected function createCategory()
    {
        $name = $this->ask('Enter category name');
        $parentId = $this->ask('Enter parent category ID (optional)', null);

        $data = [
            'name' => $name,
            'parent_id' => $parentId,
        ];

        try {
            $category = $this->categoryService->createCategory(null, $data);
            $this->info("Main Category created successfully: " . $category['name']);
        }
        catch (\Exception $e) {
            $this->error("Failed to create category: " . $e->getMessage());
        }
    }

    protected function createOrganization()
    {
        $name = $this->ask('Enter organization name');
        $countryName = $this->ask('Enter country name');
        $cityName = $this->ask('Enter city name');
        $categoryName = $this->ask('Enter category name');
        $description = $this->ask('Enter description (optional)', null);

        $data = [
            'name' => $name,
            'description' => $description,
            'country_name' => $countryName,
            'city_name' => $cityName,
            'category_name' => $categoryName,
        ];

        try {
            $organization = $this->organizationService->createOrganization(null, $data);
            $this->info("Main Organization created successfully: " . $organization['name']);
        }
        catch (\Exception $e) {
            $this->error("Failed to create organization: " . $e->getMessage());
        }
    }

    protected function createPlace()
    {
        $name = $this->ask('Enter place name');
        $countryName = $this->ask('Enter country name');
        $cityName = $this->ask('Enter city name');
        $orgId = $this->ask('Enter organization ID (optional)', null);
        $description = $this->ask('Enter description (optional)', null);

        $data = [
            'name' => $name,
            'organization_id' => $orgId,
            'description' => $description,
        ];

        try {
            $place = $this->placeService->createPlace(null, $data);
            $this->info("Main Place created successfully: " . $place['name']);
        }
        catch (\Exception $e) {
            $this->error("Failed to create place: " . $e->getMessage());
        }
    }
}
