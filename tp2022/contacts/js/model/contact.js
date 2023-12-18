class Contact {

  /////////////////////////// DELETE ///////////////////////////////////// 

  // Demande au DAO la suppression du contact ayant cet id
  static delete(id) {
    // Demande au DAO une requête
    const params = {
      'action': 'delete',
      'id': id
    }
    // Lance la requête sur le DAO
    dao.query(params,
      function (answer) {
        // Rien à faire à part détecter et afficher une erreur
        // Cas d'erreur 
        if ('error' in answer) {
          alert("Error: " + answer.error);
        }
      }
    ); 
  }

}
