<?php namespace Tests\Repositories;

use App\Models\Notifications;
use App\Repositories\NotificationsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class NotificationsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var NotificationsRepository
     */
    protected $notificationsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->notificationsRepo = \App::make(NotificationsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_notifications()
    {
        $notifications = factory(Notifications::class)->make()->toArray();

        $createdNotifications = $this->notificationsRepo->create($notifications);

        $createdNotifications = $createdNotifications->toArray();
        $this->assertArrayHasKey('id', $createdNotifications);
        $this->assertNotNull($createdNotifications['id'], 'Created Notifications must have id specified');
        $this->assertNotNull(Notifications::find($createdNotifications['id']), 'Notifications with given id must be in DB');
        $this->assertModelData($notifications, $createdNotifications);
    }

    /**
     * @test read
     */
    public function test_read_notifications()
    {
        $notifications = factory(Notifications::class)->create();

        $dbNotifications = $this->notificationsRepo->find($notifications->id);

        $dbNotifications = $dbNotifications->toArray();
        $this->assertModelData($notifications->toArray(), $dbNotifications);
    }

    /**
     * @test update
     */
    public function test_update_notifications()
    {
        $notifications = factory(Notifications::class)->create();
        $fakeNotifications = factory(Notifications::class)->make()->toArray();

        $updatedNotifications = $this->notificationsRepo->update($fakeNotifications, $notifications->id);

        $this->assertModelData($fakeNotifications, $updatedNotifications->toArray());
        $dbNotifications = $this->notificationsRepo->find($notifications->id);
        $this->assertModelData($fakeNotifications, $dbNotifications->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_notifications()
    {
        $notifications = factory(Notifications::class)->create();

        $resp = $this->notificationsRepo->delete($notifications->id);

        $this->assertTrue($resp);
        $this->assertNull(Notifications::find($notifications->id), 'Notifications should not exist in DB');
    }
}
