/* requete 1 */

insert into t_actualite_actu
values( null, 'Fermeture exceptionnelle le 14 Fevrier.', 'Nous serons exceptionnellement ferme le 14 fevrier afin de modifier le placement de certains bateaux.', '2022-05-02', 'admin1' );

/* requete 2 */

select actu_titre
from t_actualite_actu
where actu_DateDePublication = ( select max(actu_DateDePublication)
                                 from t_actualite_actu );

/* requete 3 */

select actu_titre, cpt_pseudo
from t_actualite_actu;

/* requete 4 */

select actu_titre
from t_actualite_actu 
order by actu_numero desc /* actu_DateDePublication changer en datetime au cas où il y ait plusieurs actualités le même jour */
limit = 5;

/* requete 5 */

update t_actualite_actu
set actu_titre = 'Debut exposition', actu_texte = 'L\'exposition ouvrira ses portes le 27 Janvier 2022.'
where actu_numero = 1;

/* requete 6 */

delete from t_actualite_actu
where actu_numero = 2;

/* requete 7 */

delete from t_actualite_actu
where actu_DateDePublication < '2021-01-01';

/* requete 8 */

insert into t_compte_cpt
values (MD5('test22!_OPXE'),'tEst');
insert into t_profil_pro
values ('Teddy', 'Le Moine', 'Teddy.LeMoine@univ-briec.fr', 'A', 'A', '2022-02-20', 'tEst');

/* requete 9 */

select *
from t_compte_cpt
join t_profil_pro using(cpt_pseudo)
where cpt_pseudo = 'JCOrg'
and cpt_MotDePasse = md5('G00242')
and pro_validite = 'A';

/* requete 10 */

select *
from t_profil_pro
where cpt_pseudo = 'JCOrg';

/* requete 11 */

select pro_role
from t_profil_pro
where pro_nom = 'Gerard'
and pro_prenom = 'Du Pont';

/* requete 12 */

update t_profil_pro
set pro_prenom = 'Jacques', pro_nom = 'Cerienfer'
where cpt_pseudo = 'JCOrg';

/* requete 13 */

update t_compte_cpt
set cpt_MotDePasse = md5('t3stF0nct1onnem3nt')
where cpt_pseudo = 'admin1';

/* requete 14 */

select *
from t_compte_cpt
join t_profil_pro using(cpt_pseudo);

/* requete 15 */

update t_profil_pro
set pro_validite = 'D', pro_role = 'D'
where cpt_pseudo = 'JCOrg';

/* requete 16 */

insert into t_configuration_conf
values (null, 'Voile legere.', '2022-01-27', '2022-06-27', 'Presentation de bateaux de regate "classiques" en voile legere.', 'UBO', '2021-01-28 06:30:00 PM','Bienvenue !');

/* requete 17 */

select count(conf_expo_id)
from t_configuration_conf;

/* requete 18 */

select *, DATEDIFF(conf_DateDeVernissage, CURDATE()) as ecartDateVernissage
from t_configuration_conf;

/* requete 19 */

update t_configuration_conf
set conf_intitule = 'Voile de competition', conf_DateDeVernissage = '2022-06-18 18:00:00', conf_lieu = 'Port-Muse'
where conf_expo_id = 1;

/* requete 20 */

delete from t_configuration_conf
where conf_expo_id = 1;

/* requete 21 */

insert into t_visiteurs_vis
values (null, 'azertyqsdfghwxcvb', NOW(), null, null, null, 'JCOrg');

/* requete 22 */

select t_visiteurs_vis.vis_id, vis_email, com_text
from t_visiteurs_vis
left outer join t_commentaire_com
on t_visiteurs_vis.vis_id = t_commentaire_com.vis_id;

/* requete 23 */

delete from t_commentaire_com
where vis_id = 10;
delete from t_visiteurs_vis
where vis_id = 10;

/* requete 24 */

set @nbticket = (select count(vis_id) from t_visiteurs_vis);

select 100 - count(vis_id)/@nbticket * 100 as Pourcentage
from t_commentaire_com;

/* requete 25 */

insert into t_commentaire_com
values(null, NOW(), 'Il n\'y a pas assez d\'oeuvres.', 11);
update t_visiteurs_vis
set vis_nom = 'Parabellum', vis_prenom = 'Jacques', vis_email = 'JPPacem@coldmail.com'
where vis_id = 11
and vis_MotDePasse = 'azertyqsdfghwxcvb';

/*
( select vis_id
  from t_visiteurs_vis
  where vis_id = 11
  and hour(timediff(NOW(), vis_DateHeure)) <= 3)
*/

/*
select timestampadd(3, vis_DateHeure)
from t_visiteurs_vis
where vis_id = 11;

set @id_3h_ok = (select vis_id
                from t_visiteurs_vis
                where vis_DateHeure <= NOW()
                and NOW() <= timestampadd(hour, 3, vis_DateHeure)
                and vis_id = 11);
select @id_3h_ok;
*/

/* requete 26 */

update t_commentaire_com
set com_etat = 'C'
where vis_id = 11;

/* requete 27 */

select com_text
from t_commentaire_com
where com_etat = 'V';

/* requete 28 */

select com_text, com_etat, vis_email
from t_commentaire_com
join t_visiteurs_vis using(vis_id);

/* requete 29 */

update t_commentaire_com
set com_text = 'Commentaire invalide.', com_etat = 'C'
where vis_id = (select vis_id
                from t_visiteurs_vis
                where vis_id = 10
                and vis_MotDePasse = 'azertyqsdfghwxc');

/*
delete from t_commentaire_com
where com_numero = ( select com_numero
                     from t_commentaire_com
                     join t_visiteurs_vis using (vis_id)
                     where vis_id = 10
                     and vis_MotDePAsse = 'azertyqsdfghwxc');
*/

/* requete 30 */

insert into t_oeuvre_oeu
values (null, 'test', '2000-01-01', 'test test test', 'photo');

/* requete 31 */

select oeu_intitule, oeu_description, oeu_CheminPhoto
from t_oeuvre_oeu;

/* requete 32 */

select *
from t_oeuvre_oeu
where oeu_code = 6;

/* requete 33 */

select expo_nom, expo_biographie, expo_UrlSite, expo_CheminPhoto
from t_exposant_expo;

/* requete 34 */

select *
from t_exposant_expo
where expo_identifiant = 8;

/* requete 35 */

create view nbExpoOeu
as select count(expo_identifiant) as nbExpo, oeu_code
from t_presentation_pres
group by oeu_code;

select oeu_code
from t_oeuvre_oeu
join nbExpoOeu using (oeu_code)
where nbExpo > 1;

/*
select oeu_code, count(expo_identifiant)
from t_presentation_pres
group by oeu_code
having count(expo_identifiant) > 1;
*/

/* requete 36 */

select *
from t_oeuvre_oeu;

/* requete 37 */

select expo_identifiant
from t_presentation_pres
join nbExpoOeu using (oeu_code) 
where nbExpo > 1;

/*
select expo_identifiant
from t_presentation_pres
where oeu_code in (select oeu_code
                 from t_presentation_pres
                 group by oeu_code
                 having count(expo_identifiant) > 1);
*/

/* requete 38 */

delete from *
where expo_identifian t = (select expo_identifiant
                          from t_presentation_pres
                          join nbExpoOeu using (oeu_code)
                          where nbExpo =1);

/*
select expo_identifiant
from t_presentation_pres
where oeu_code in ( select oeu_code
                    from t_presentation_pres
                    group by oeu_code
                    having count(oeu_id) = 1);

delete from t_presentation_pres
where expo_identifiant = 8
and oeu_code not in (select oeu_id
                     from t_presentation_pres
                     group by oeu_id
                     having count(expo_id) > 1);
*/

/* requete 39 */


delete from t_presentation_pres
where oeu_code = 9;

delete from t_oeuvre_oeu
where oeu_code = 9;


/* requete 40 */

update t_exposant_expo
set expo_nom = 'test', expo_prenom = 'test', expo_biographie = 'test', expo_email = 'test', expo_UrlSite = 'test', expo_CheminPhoto = 'test'
where expo_identifiant = 5;

/* requete 41 */

update t_presentation_pres
set expo_identifiant = 3, oeu_code = 3
where oeu_code = 2
and expo_identifiant = 2;

/* requete 42 */

delete from t_oeuvre_oeu
where t_oeuvre_oeu.oeu_code = ( select oeu_code
                                from t_oeuvre_oeu
                                except
                                select distinct oeu_code
                                from t_presentation_pres);

/* ne fonctionne pas avec "not in", au lieu de "=" */
