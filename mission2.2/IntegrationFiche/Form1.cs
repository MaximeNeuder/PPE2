using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using mission2;


namespace IntegrationFiche
{
    public partial class Form1 : Form
    {
        string path = @"..\..\..\..\documentsWord\";
        List<string> rep = new List<string>();
        
        

        public Form1()
        {
            InitializeComponent();

            List<string> Fiches = UtilitairesIntegrationBd.LesFiches(path);

            cheminLivre.Items.Add(path);

            cheminLivre.SelectedIndex = 0;
            

            foreach (string fiche in Fiches)
            {
                listeLivre.Items.Add(fiche);
            } 
        }

        private void Lancer_Click(object sender, EventArgs e)
        {
            List<string> fiches = new List<string>();
            foreach(object o in listeLivre.CheckedItems)
            {
                fiches.Add(Convert.ToString(o));
                     
            }
            UtilitairesIntegrationBd.IntegrationFiches(path, fiches);   
            
        }


        private void Repertoires_Click(object sender, EventArgs e)
        {
            folderBrowserDialog1.ShowDialog();
            cheminLivre.Items.Add(folderBrowserDialog1.SelectedPath);
            cheminLivre.SelectedIndex = cheminLivre.Items.Count - 1;
            listeLivre.Items.Clear();
            path = Convert.ToString(cheminLivre.SelectedItem);
            List<string> Fiches = UtilitairesIntegrationBd.LesFiches(path);
            foreach (string fiche in Fiches)
            {
                listeLivre.Items.Add(fiche);
            }
            rep.Add(cheminLivre.SelectedIndex.ToString());
        }

        private void ToutSelectionner_Click(object sender, EventArgs e)
        {
            for (int i = 0; i < listeLivre.Items.Count ; i++)
            {
                listeLivre.SetItemChecked(i, true);
            }
        }

        private void ToutDeselectionner_Click(object sender, EventArgs e)
        {
            for (int i = 0; i < listeLivre.Items.Count; i++)
            {
                listeLivre.SetItemChecked(i, false);
            }
        }

        private void listeLivre_SelectedIndexChanged(object sender, EventArgs e)
        {
            
        }

        private void listeLivre_ItemCheck(object sender, ItemCheckEventArgs e)
                {
            //int i = listeLivre.CheckedItems.Count;
                    int i = 0;
                    foreach (object o in listeLivre.CheckedItems)
                    {
                        i = i + 1;
                    }
                    nbFiche.Text = "Vous avez selectionné " + i + " fiches";
        }

    }
}
