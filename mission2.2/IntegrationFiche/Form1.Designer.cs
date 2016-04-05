namespace IntegrationFiche
{
    partial class Form1
    {
        /// <summary>
        /// Variable nécessaire au concepteur.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Nettoyage des ressources utilisées.
        /// </summary>
        /// <param name="disposing">true si les ressources managées doivent être supprimées ; sinon, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Code généré par le Concepteur Windows Form

        /// <summary>
        /// Méthode requise pour la prise en charge du concepteur - ne modifiez pas
        /// le contenu de cette méthode avec l'éditeur de code.
        /// </summary>
        private void InitializeComponent()
        {
            this.RepertoireQuizz = new System.Windows.Forms.Label();
            this.QuizzIntegration = new System.Windows.Forms.Label();
            this.cheminLivre = new System.Windows.Forms.ComboBox();
            this.listeLivre = new System.Windows.Forms.CheckedListBox();
            this.Lancer = new System.Windows.Forms.Button();
            this.Repertoires = new System.Windows.Forms.Button();
            this.folderBrowserDialog1 = new System.Windows.Forms.FolderBrowserDialog();
            this.ToutSelectionner = new System.Windows.Forms.Button();
            this.ToutDeselectionner = new System.Windows.Forms.Button();
            this.nbFiche = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // RepertoireQuizz
            // 
            this.RepertoireQuizz.AutoSize = true;
            this.RepertoireQuizz.Location = new System.Drawing.Point(17, 15);
            this.RepertoireQuizz.Name = "RepertoireQuizz";
            this.RepertoireQuizz.Size = new System.Drawing.Size(104, 13);
            this.RepertoireQuizz.TabIndex = 0;
            this.RepertoireQuizz.Text = "répertoire des quizz :";
            // 
            // QuizzIntegration
            // 
            this.QuizzIntegration.AutoSize = true;
            this.QuizzIntegration.Location = new System.Drawing.Point(37, 95);
            this.QuizzIntegration.Name = "QuizzIntegration";
            this.QuizzIntegration.Size = new System.Drawing.Size(84, 13);
            this.QuizzIntegration.TabIndex = 1;
            this.QuizzIntegration.Text = "quizz à intégrer :";
            // 
            // cheminLivre
            // 
            this.cheminLivre.FormattingEnabled = true;
            this.cheminLivre.Location = new System.Drawing.Point(127, 12);
            this.cheminLivre.Name = "cheminLivre";
            this.cheminLivre.Size = new System.Drawing.Size(255, 21);
            this.cheminLivre.TabIndex = 2;
            // 
            // listeLivre
            // 
            this.listeLivre.FormattingEnabled = true;
            this.listeLivre.Location = new System.Drawing.Point(199, 84);
            this.listeLivre.Name = "listeLivre";
            this.listeLivre.Size = new System.Drawing.Size(254, 94);
            this.listeLivre.TabIndex = 3;
            this.listeLivre.ItemCheck += new System.Windows.Forms.ItemCheckEventHandler(this.listeLivre_ItemCheck);
            this.listeLivre.SelectedIndexChanged += new System.EventHandler(this.listeLivre_SelectedIndexChanged);
            // 
            // Lancer
            // 
            this.Lancer.Location = new System.Drawing.Point(198, 210);
            this.Lancer.Name = "Lancer";
            this.Lancer.Size = new System.Drawing.Size(128, 23);
            this.Lancer.TabIndex = 4;
            this.Lancer.Text = "Lancer l\'intégration";
            this.Lancer.UseVisualStyleBackColor = true;
            this.Lancer.Click += new System.EventHandler(this.Lancer_Click);
            // 
            // Repertoires
            // 
            this.Repertoires.Location = new System.Drawing.Point(397, 12);
            this.Repertoires.Name = "Repertoires";
            this.Repertoires.Size = new System.Drawing.Size(75, 23);
            this.Repertoires.TabIndex = 5;
            this.Repertoires.Text = "Repertoires";
            this.Repertoires.UseVisualStyleBackColor = true;
            this.Repertoires.Click += new System.EventHandler(this.Repertoires_Click);
            // 
            // ToutSelectionner
            // 
            this.ToutSelectionner.Location = new System.Drawing.Point(208, 55);
            this.ToutSelectionner.Name = "ToutSelectionner";
            this.ToutSelectionner.Size = new System.Drawing.Size(100, 23);
            this.ToutSelectionner.TabIndex = 6;
            this.ToutSelectionner.Text = "ToutSelectionner";
            this.ToutSelectionner.UseVisualStyleBackColor = true;
            this.ToutSelectionner.Click += new System.EventHandler(this.ToutSelectionner_Click);
            // 
            // ToutDeselectionner
            // 
            this.ToutDeselectionner.Location = new System.Drawing.Point(328, 55);
            this.ToutDeselectionner.Name = "ToutDeselectionner";
            this.ToutDeselectionner.Size = new System.Drawing.Size(112, 23);
            this.ToutDeselectionner.TabIndex = 7;
            this.ToutDeselectionner.Text = "ToutDeselectionner";
            this.ToutDeselectionner.UseVisualStyleBackColor = true;
            this.ToutDeselectionner.Click += new System.EventHandler(this.ToutDeselectionner_Click);
            // 
            // nbFiche
            // 
            this.nbFiche.AutoSize = true;
            this.nbFiche.Location = new System.Drawing.Point(48, 165);
            this.nbFiche.Name = "nbFiche";
            this.nbFiche.Size = new System.Drawing.Size(35, 13);
            this.nbFiche.TabIndex = 8;
            this.nbFiche.Text = "label1";
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(480, 262);
            this.Controls.Add(this.nbFiche);
            this.Controls.Add(this.ToutDeselectionner);
            this.Controls.Add(this.ToutSelectionner);
            this.Controls.Add(this.Repertoires);
            this.Controls.Add(this.Lancer);
            this.Controls.Add(this.listeLivre);
            this.Controls.Add(this.cheminLivre);
            this.Controls.Add(this.QuizzIntegration);
            this.Controls.Add(this.RepertoireQuizz);
            this.Name = "Form1";
            this.Text = "Alimentation de la base de données : Livres & Quizz";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label RepertoireQuizz;
        private System.Windows.Forms.Label QuizzIntegration;
        private System.Windows.Forms.ComboBox cheminLivre;
        private System.Windows.Forms.CheckedListBox listeLivre;
        private System.Windows.Forms.Button Lancer;
        private System.Windows.Forms.Button Repertoires;
        private System.Windows.Forms.FolderBrowserDialog folderBrowserDialog1;
        private System.Windows.Forms.Button ToutSelectionner;
        private System.Windows.Forms.Button ToutDeselectionner;
        private System.Windows.Forms.Label nbFiche;
    }
}

