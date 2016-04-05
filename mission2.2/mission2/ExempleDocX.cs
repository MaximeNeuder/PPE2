using Novacode;
using System;
using System.Collections.Generic;
using System.Drawing;
using System.Drawing.Imaging;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace mission2
{
    class ExempleDocX
    {
        public static void ExtractionQuizz(string fiche)
        {
            Console.WriteLine("document {0}", fiche);
            int index = 1;
            // ouvre un document word.
            using (DocX document = DocX.Load(fiche))
            {
                //Parcours de tous les paragraphes du document et affichage sur la console
                foreach (Paragraph p in document.Paragraphs)
                {
                    Console.WriteLine("paragraphe {0} : {1}", index, p.Text);
                    index++;
                }
            } // le document word est fermé.
        }

        public static void ExtractionPhoto(string fiche)
        {
            // ouvre un document word.
            using (DocX document = DocX.Load(fiche))
            {
                // On parcourt toutes les images du document word
                foreach (Novacode.Image image in document.Images)
                {
                    try
                    {
                        // récupération du flux image
                        Stream s = image.GetStream(FileMode.Open, FileAccess.Read);
                        // instanciation d'un objet de type image
                        Bitmap b = new Bitmap(s);
                        //Sauvegarde de l'image au format jpeg
                        b.Save("Fiche-Exemple.jpeg", ImageFormat.Jpeg);
  
                    }
                    catch
                    {
                        //la conversion est impossible ce n'est pas une image. rien n'est fait
                    }
                }
            }  // le document word est fermé.
        }

    }
}
