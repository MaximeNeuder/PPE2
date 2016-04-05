using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;
using System.IO;
namespace mission2
{
    class Program
    {
        static void Main(string[] args)
        {
      /*  string path = @"U:\PPE\rallyeLecture\02 alimentation Base De données\ressources\documentsWord";
		string file = path + @"\Fiche 1 Ben est amoureux d'Anna.docx";
		ExempleDocX.ExtractionQuizz(file);
		ExempleDocX.ExtractionPhoto(file);
		Console.ReadLine(); */

 /*       // définition de la connexion à la base de données
   string   sRlConnexion = "user=root;password=siojjr;host=127.0.0.1;database=rallyeLecture";
   MySqlConnection rlConnexion = new MySqlConnection(sRlConnexion);
        // Table Auteur définition de la requête
        // création d'une requête paramétrée
     MySqlCommand  insertAuteur = new MySqlCommand("insert into Auteur(nom) values(@p1)", rlConnexion);
        // On définit le paramètre
        insertAuteur.Parameters.Add(new MySqlParameter("@p1", MySqlDbType.VarChar));
        // insert auteur utilisation de la requête
        // le premier paramètre de la requête est alimenté
        insertAuteur.Parameters[0].Value = "nom de l'auteur";
        // on se connecte
        rlConnexion.Open();
        // la requete est exécutée
        insertAuteur.ExecuteNonQuery();
        // On récupère l'id unique générée lors de l'insert de l'auteur
        int idAuteur = insertAuteur.LastInsertedId;
        rlConnexion.Close(); */

            string path = @"G:\PPE\rallyeLecture\02 alimentation Base De données\ressources\documentsWord\";







            Console.ReadLine();

            

        }
    }
}
