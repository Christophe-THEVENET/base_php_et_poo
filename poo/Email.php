<?php

class Email
{
  private string $email;


// en dessous c est l extention Dock Blocker qui permet d ajouter des commentaires sur une fonction ou a autre. par la suite au survol de l'instantiation d'un objet de la classe Email, des infos supplémentaires seront indiquees par vscode 

  /**
   * Créer une nouvelle instance de la classe Email
   *
   * @param string $email transmet la chaine de caractère de l email
   * @return Email
   * @throws InvalidArgumentException si format d email invalide on lance une exeption
   */
  public function __construct(string $email)
  {
    $this->email = $email;

    if (!$this->isValid()) {
      throw new InvalidArgumentException("Le format de l'email est incorrect"); // lancer une nouvelle exeption embarqué (sera dans le message d'erreur natif (Fatal error) de php) throw stoppe l'instanciation si l email n est pas valide
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
