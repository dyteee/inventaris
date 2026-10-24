<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventorySystemTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $regularUser;
    protected Category $category;
    protected Item $item;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->regularUser = User::create([
            'name' => 'User Test',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $this->category = Category::create([
            'name' => 'Elektronik & Multimedia',
        ]);

        $this->item = Item::create([
            'category_id' => $this->category->id,
            'name' => 'Proyektor Epson',
            'code' => 'PRJ-01',
            'stock' => 5,
            'condition' => 'baik',
        ]);
    }

    public function test_admin_can_access_categories_and_items(): void
    {
        $response = $this->actingAs($this->admin)->get('/categories');
        $response->assertStatus(200);

        $response = $this->actingAs($this->admin)->get('/items');
        $response->assertStatus(200);
    }

    public function test_regular_user_cannot_access_categories_crud(): void
    {
        $response = $this->actingAs($this->regularUser)->get('/categories');
        $response->assertStatus(403);
    }

    public function test_user_can_borrow_an_item_and_stock_decrements(): void
    {
        $response = $this->actingAs($this->regularUser)->post('/loans', [
            'item_id' => $this->item->id,
            'quantity' => 2,
            'loan_date' => now()->toDateString(),
            'due_date' => now()->addDays(3)->toDateString(),
        ]);

        $response->assertRedirect('/loans');
        $this->assertDatabaseHas('loans', [
            'user_id' => $this->regularUser->id,
            'item_id' => $this->item->id,
            'quantity' => 2,
            'status' => 'dipinjam',
        ]);

        $this->assertEquals(3, $this->item->fresh()->stock);
    }

    public function test_admin_can_verify_return_and_stock_increments(): void
    {
        $loan = Loan::create([
            'user_id' => $this->regularUser->id,
            'item_id' => $this->item->id,
            'quantity' => 2,
            'loan_date' => now()->subDays(2)->toDateString(),
            'due_date' => now()->addDay()->toDateString(),
            'status' => 'dipinjam',
        ]);
        $this->item->update(['stock' => 3]);

        $response = $this->actingAs($this->admin)->post('/return-logs', [
            'loan_id' => $loan->id,
            'returned_at' => now()->toDateString(),
            'condition_on_return' => 'baik',
            'notes' => 'Barang kembali lengkap.',
        ]);

        $response->assertRedirect(route('return_logs.index'));
        $this->assertDatabaseHas('return_logs', [
            'loan_id' => $loan->id,
            'condition_on_return' => 'baik',
        ]);

        $this->assertEquals('dikembalikan', $loan->fresh()->status);
        $this->assertEquals(5, $this->item->fresh()->stock);
    }
}
