<?php

class Email
{
  private string $email;

  /**
   * Creates a new instance of Email class
   *
   * @param string $email Plain text email
   * @return Email
   * @throws InvalidArgumentException if Email format is invalid
   */
  public function __construct(string $email)
  {
    $this->email = $email;

    if (!$this->isValid()) {
      throw new InvalidArgumentException("Le format de l'email est incorrect"); // lancer une nouvelle exeption embarqué throw stoppe l'instanciation si l email n est pas valide
    }
  }

  public function isValid(): bool
  {
    return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false; // filter_var ===> fonction native php pour valider la syntaxe d'une adresse mail. On applique un filtre (variable FILTER_VALIDATE_EMAIL)  elle integre une regex
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }
}
