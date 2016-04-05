using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;
using Novacode;
using System.Collections;
using System.IO;
using System.Drawing;

namespace mission2 {
    public static class UtilitairesIntegrationBd {
        private static MySqlConnection connexion = new MySqlConnection("server=172.16.0.158;uid=root;database=lecture;port=3306;password=siojjr");
        private static MySqlCommand insertAuteur;
        private static MySqlCommand insertEditeur;
        private static MySqlCommand insertLivre;
        private static MySqlCommand insertProposition;
        private static MySqlCommand insertQuestion;
        private static MySqlCommand insertQuizz;
        private static MySqlCommand readerLivre;
        private static MySqlCommand updateLivre;
        private static int idPhoto = 0;
        private static int idAuteur = 0;
        private static int idEditeur = 0;
        private static int idQuizz = 0;
        private static int idQuestion = 0;

        public static void ExtractionPhoto(string path, string fiche) {
            using (DocX document = DocX.Load(path + fiche)) {
                foreach (Novacode.Image image in document.Images) {
                    idPhoto++;
                    try {
                        Stream s = image.GetStream(FileMode.Open, FileAccess.Read);
                        Bitmap b = new Bitmap(s);
                        b.Save("Test" + Convert.ToString(idPhoto) + ".jpeg", System.Drawing.Imaging.ImageFormat.Jpeg);
                    } catch { }
                }
            }
        }

        public static void ExtractionQuizz(string path, string nomFiche) {
            string question = "";

            int idFiche = 0;
            if (nomFiche != "correctionFiches.docx") {
                idFiche = GetIdFiche(nomFiche);
            }

            if (nomFiche == "correctionFiches.docx") {
                return;
            }

            DocX document = DocX.Load(path + "\\" + nomFiche);

            int index = 0;
            Paragraph p = document.Paragraphs[index];
            while (p.Text != "QUESTION") {
                if (p.Text != "") {
                    if (p.Text.Contains("Nom")) {

                    }

                    if (p.Text.Contains("titre")) {
                        string titre = p.Text;
                    }

                    if (p.Text.Trim().StartsWith("de")) {
                        string auteur = "";
                        string editeur = "";

                        idAuteur++;
                        idEditeur++;
                        idQuizz++;

                        if (p.Text.Contains("-")) {
                            auteur = p.Text.Trim().Substring(3, p.Text.Trim().IndexOf("-") - 4);
                            editeur = p.Text.Trim().Substring(p.Text.Trim().IndexOf("-") + 2);
                        }

                        if (p.Text.Contains("–")) {
                            auteur = p.Text.Trim().Substring(3, p.Text.Trim().IndexOf("–") - 4);
                            editeur = p.Text.Trim().Substring(p.Text.Trim().IndexOf("–") + 2);
                        }

                        insertAuteur = new MySqlCommand();
                        insertAuteur.Connection = connexion;
                        insertAuteur.CommandType = System.Data.CommandType.Text;
                        insertAuteur.CommandText = String.Format("insert into auteur values({0}, \"{1}\")", idAuteur, auteur);
                        try {
                            insertAuteur.ExecuteNonQuery();
                        } catch (MySqlException e) { }

                        insertEditeur = new MySqlCommand();
                        insertEditeur.Connection = connexion;
                        insertEditeur.CommandType = System.Data.CommandType.Text;
                        insertEditeur.CommandText = String.Format("insert into editeur values({0}, \"{1}\")", idEditeur, editeur);
                        try {
                            insertEditeur.ExecuteNonQuery();
                        } catch (MySqlException e) { }

                        insertQuizz = new MySqlCommand();
                        insertQuizz.Connection = connexion;
                        insertQuizz.CommandType = System.Data.CommandType.Text;
                        insertQuizz.CommandText = String.Format("insert into quizz values(\"{0}\",\"{1}\")", idQuizz, idFiche);
                        try {
                            insertQuizz.ExecuteNonQuery();
                        } catch (MySqlException e) { }
                    }

                    if (p.Text.EndsWith("?") || p.Text.EndsWith(":")) {
                        idQuestion++;
                        insertQuestion = new MySqlCommand();
                        insertQuestion.CommandType = System.Data.CommandType.Text;
                        insertQuestion.Connection = connexion;
                        insertQuestion.CommandText = String.Format("insert into question values({0}, \"{1}\", 1, {2})", idQuestion, p.Text, idQuizz);
                        try {
                            insertQuestion.ExecuteNonQuery();
                        }
                        catch (MySqlException e) { }
                    }
                    else {

                    }
                }

                index++;
                p = document.Paragraphs[index];
            }
            // }
        }

        public static void ExtractionSolution(string path) {

        }

        public static int GetIdFiche(string nomFiche) {
            string id;
            int idLivre = 0;
            id = nomFiche.Substring(6, 3);
            idLivre = Int32.Parse(id);
            return idLivre;
        }

        public static void IntegrationFiches(string path, List<string> fiches) {
            connexion.Open();

            UtilitairesIntegrationBd.ViderBase();
            foreach (string nomFiche in fiches) {
                ExtractionQuizz(path, nomFiche);
                ExtractionPhoto(path, nomFiche);
            }

            connexion.Close();
        }

        public static List<string> LesFiches(string path) {
            List<string> fichiers = new List<string>(Directory.EnumerateFiles(path));

            List<string> f = new List<string>();

            foreach (var fiche in fichiers) {
                FileInfo file = new FileInfo(fiche);
                string extension = file.Extension;
                string nom = file.Name;

                if (extension == ".docx" && nom.Contains("Fiche")) {
                    f.Add(nom);
                }
            }
            return f;
        }

        public static void ViderBase() {
            MySqlCommand toutEffacer = new MySqlCommand();

            toutEffacer.Connection = connexion;

            toutEffacer.CommandType = System.Data.CommandType.Text;

            toutEffacer.CommandText = "delete from livre;delete from auteur;delete from editeur;delete from quizz;delete from proposition;delete from question;";

            toutEffacer.ExecuteNonQuery();
        }
    }
}
