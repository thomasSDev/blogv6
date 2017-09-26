<?php
namespace formBuilder;
 
use \fram\FormBuilder;
use \fram\StringField;
use \fram\TextField;
use \fram\MaxLengthValidator;
use \fram\NotNullValidator;
 
class PrefaceFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Auteur',
        'name' => 'auteur',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long (20 caractères maximum)', 20),
          new NotNullValidator('Merci de spécifier l\'auteur de la préface'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Titre',
        'name' => 'titre',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le titre de la préface'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Contenu',
        'name' => 'contenu',
        'rows' => 8,
        'cols' => 60,
        'validators' => [
          new NotNullValidator('Merci de spécifier le contenu de la préface'),
        ],
       ]));
  }
}