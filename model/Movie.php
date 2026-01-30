<?php
// Model/Movie.php

class Movie {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    private static string $posterPath = "posters/";

    public int $movieId;
    public ?string $movieName;
    public ?string $movieDescription;
    public ?string $trailerFileName;
    public ?string $posterFileName;

    public function __construct(
        ?int $id,
        string $name,
        ?string $description = null,
        ?string $trailer = null,
        ?string $poster = null
    ) {
        $this->movieId = $id;
        $this->movieName = $name;
        $this->movieDescription = $description;
        $this->trailerFileName = $trailer;
        $this->posterFileName = $poster;
    }

    // Example of pure business logic (no DB knowledge)
    public function getPoster(): string {
        // [Inference] Assuming posters are stored in a 'posters' folder
        if ($this->posterFileName) {
            return self::$posterPath .  $this->posterFileName;
        }
        return self::$posterPath . "default.png";
    }

    public function getTrailer(): string {
        // [Inference] Assuming posters are stored in a 'posters' folder
        if ($this->trailerFileName) {
            return $this->trailerFileName;
        }
        return "https://www.youtube.com/embed/w2b0QT3lXOw?si=ldNNGCvsTXqtx4FT";  // Default trailer link
    }

    // Example of a data validation method
    public function isValid(): bool {
        return !empty($this->movieName);
    }
}