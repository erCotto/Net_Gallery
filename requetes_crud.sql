/* fiche requete */

/* requete 1 */

update t_profil_pro
set pro_validite = 'D', pro_role = 'D'
where cpt_pseudo = 'JCOrg';

/* requete 2 */

delete from t_profil_pro
where cpt_pseudo = 'JCOrg';
/*
delete from t_compte_cpt
where cpt_pseudo = 'JCOrg';

On doit avoir le même nombre de lignes dans les deux tables, mais supprimer le compte engendre une perte de données,
il vaut mieux le désactiver.
*/

/* requete 3 */

select pro_nom, pro_prenom, pro_role
from t_profil_pro
order by pro_prenom;

select pro_nom, pro_prenom, pro_role
from t_profil_pro
order by pro_role;

/* requete 4 */

select pro_prenom, pro_nom, pro_email
from t_profil_pro
where pro_role = 'O'
order by pro_prenom desc;

/* requete 5 */

select pro_prenom, pro_nom
from t_profil_pro
where YEAR(pro_DateDeCreation) = 2018;

/* requete 6 */

insert into t_actualite_actu
values(null, 'Plus de 1 000 entrees !', 'Aujourd\'hui nous avons depasse les 1 000 entrees dans l\'exposition.', CURDATE(), 'JCOrg' );

/* requete 7 */

select actu_numero, actu_texte
from t_actualite_actu
where actu_DateDePublication = ( select max(actu_DateDePublication)
                                 from t_actualite_actu );

/* utiliser actu_numero ou passer le type en DATETIME au cas où plusieurs actualites sont ajoutes le meme jour */

/* requete 8 */

select actu_titre
from t_actualite_actu
where actu_DateDePublication < '2022-02-01'
and actu_DateDePublication > '2020-02-01';

/* requete 9 */

select count(cpt_pseudo) as nbOrga
from t_profil_pro
where pro_role = 'O';

select count(cpt_pseudo) as nbAdmin
from t_profil_pro
where pro_role = 'A';

/* requete 10 */

select distinct pro_role
from t_profil_pro;

/* requete 11 */

set @nbticket = (select count(cpt_pseudo) from t_visiteurs_vis);

select count(cpt_pseudo)/@nbticket * 100 as Pourcentage
from t_visiteurs_vis
where cpt_pseudo = 'gEstionnaire';

/* requete 12 */

select *
from t_compte_cpt
join t_profil_pro using(cpt_pseudo)
where cpt_pseudo = 'JCOrg'
and cpt_MotDePasse = md5('G00242')
and pro_validite = 'A';

/* requete 13 */

delete from *
where cpt_pseudo = 'mdurand';

/* requete 14 */

set @nbcompte = (select count(cpt_pseudo) from t_compte_cpt);

select count(cpt_pseudo) - @nbcompte as diffNbComptesProfil
from t_profil_pro;

/* requete 15 */

create view pseudo_cpt_pro
as select cpt_pseudo
from t_compte_cpt
join t_profil_pro using (cpt_pseudo);

delete from t_compte_cpt
where t_compte_cpt.cpt_pseudo != pseudo_cpt_pro.cpt_pseudo;

