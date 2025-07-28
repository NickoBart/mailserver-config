<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        return [
            'name'         => $this->faker->name(),
            'email'        => $this->faker->unique()->safeEmail(),
            'domain'       => $this->faker->domainName(),
            'preference_id'=> $this->faker->uuid(),
            'init_point'   => $this->faker->url(),
            'status'       => 'pending',
            'expires_at'   => now()->addMonth(),
            'plan_name'    => null,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}
