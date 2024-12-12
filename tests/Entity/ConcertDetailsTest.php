<?php

namespace App\Tests\Entity;

use App\Entity\Artists;
use App\Entity\ConcertDetails;
use App\Entity\Dates;
use App\Entity\Scenes;
use App\Entity\Schedules;
use PHPUnit\Framework\TestCase;

class ConcertDetailsTest extends TestCase
{
    // Test pour vérifier que l'ID est initialement null
    public function testGetSetId()
    {
        $concertDetails = new ConcertDetails();
        $this->assertNull($concertDetails->getId());
    }

    // Test pour vérifier que l'artiste peut être défini et récupéré correctement
    public function testGetSetArtist()
    {
        $concertDetails = new ConcertDetails();
        $artist = new Artists();
        $concertDetails->setArtist($artist);

        $this->assertSame($artist, $concertDetails->getArtist());
    }

    // Test pour vérifier que la scène peut être définie et récupérée correctement
    public function testGetSetScene()
    {
        $concertDetails = new ConcertDetails();
        $scene = new Scenes();
        $concertDetails->setScene($scene);

        $this->assertSame($scene, $concertDetails->getScene());
    }

    // Test pour vérifier que la date peut être définie et récupérée correctement
    public function testGetSetDate()
    {
        $concertDetails = new ConcertDetails();
        $date = new Dates();
        $concertDetails->setDate($date);

        $this->assertSame($date, $concertDetails->getDate());
    }

    // Test pour vérifier que l'horaire peut être défini et récupéré correctement
    public function testGetSetSchedule()
    {
        $concertDetails = new ConcertDetails();
        $schedule = new Schedules();
        $concertDetails->setSchedule($schedule);

        $this->assertSame($schedule, $concertDetails->getSchedule());
    }

    // Test pour vérifier que la date de création peut être définie et récupérée correctement
    public function testGetSetCreatedAt()
    {
        $concertDetails = new ConcertDetails();
        $createdAt = new \DateTimeImmutable();
        $concertDetails->setCreatedAt($createdAt);

        $this->assertSame($createdAt, $concertDetails->getCreatedAt());
    }

    // Test pour vérifier que l'état de publication peut être défini et récupéré correctement
    public function testGetSetPublish()
    {
        $concertDetails = new ConcertDetails();
        $concertDetails->setPublish(true);

        $this->assertTrue($concertDetails->getPublish());
    }
}
