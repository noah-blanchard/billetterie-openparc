import React from 'react'
import styles from './Reserver.module.css'

import axios from 'axios'

import Box from '@mui/material/Box';
import Link from "@mui/material/Link"
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import FormControl from '@mui/material/FormControl';
import Select from '@mui/material/Select';
import TextField from '@mui/material/TextField';
import Button from '@mui/material/Button';
import Modal from '@mui/material/Modal';
import Typography from '@mui/material/Typography';

import { useEffect, useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';

const Reserver = () => {


    const [open, setOpen] = useState(false);
    const [age, setAge] = useState(0);

    const [passConf, setPassConf] = useState('');

    const [validate, setValidate] = useState(false)

    const [promo, setPromo] = useState('');

    const navigate = useNavigate();

    const [matchs, setMatchs] = useState([]);
    const [selectMatch, setSelectMatch] = useState({})
    const [joueurs, setJoueurs] = useState([]);
    const [lesPlaces, setLesPlaces] = useState([]);
    const [placesDispo, setPlacesDispo] = useState([]);


    const [selected, setSelected] = useState(-1);
    const [place, setPlace] = useState(-1);
    const [cate, setCate] = useState(2);

    const [chargement, setChargement] = useState(true);

    const [tribune, setTribune] = useState(-1);

    const [nom, setNom] = useState('');
    const [prenom, setPrenom] = useState('');
    const [email, setEmail] = useState('');
    const [pass, setPass] = useState('');
    const [tel, setTel] = useState("");
    const [prix, setPrix] = useState(0);

    const { id } = useParams();

    const tribunes = ["Ouest", "Est", "Nord", "Sud"];

    const handleChange = (event) => {
        setSelected(event.target.value);



        if (event.target.value > 0) {

            const selectedMatch = matchs.filter(m => {
                return m.idMatch.id == event.target.value;
            })[0].idMatch;

            setSelectMatch(selectedMatch);

            filterPlace(selectedMatch.placesReservees);
        } else {
            setTribune(-1); setPlace(-1);
        }

    };

    const filterPlace = (placesReservees) => {
        let tabPlacesReservees = placesReservees.map(p => {
            return p.place.id;
        })

        let placeD = lesPlaces;

        for (let idReservee of tabPlacesReservees) {

            placeD = placeD.filter(place => {
                return place.id != idReservee;
            })
        }

        setPlacesDispo(placeD);


    }

    const handleChangePlace = (event) => {
        setPlace(event.target.value);
    }

    const mapPlace = () => {
        const tabPlace = placesDispo.filter(p => {
            return p.tribune == tribune;
        })



        return tabPlace.map(p => {
            return <MenuItem key={p.id} value={p.id}>Place {p.id} - Cat {p.cat}</MenuItem>
        })
        //<MenuItem key={m.idMatch.id} value={m.idMatch.id}>{m.idMatch.id} - {j.nom1} contre {j.nom2 != "-1" ? j.nom2 : "Non Déterminé"} - {m.heure}:{m.minute}0</MenuItem>
    }


    const getJoueurById = async (idJ, idJ2, idR) => {
        let response = await axios.get("https://cpoa.noahblanchard.fr/api/joueurs/" + idJ);
        let data = await response.data;
        let response2 = await axios.get("https://cpoa.noahblanchard.fr/api/joueurs/" + idJ2);
        let data2 = await response2.data;

        const id = await {
            idR: idR,
            nom1: data.nom,
            nom2: data2.nom
        }

        return id;
    }
    const getMatchsPrincipal = async () => {
        try {
            let response = await axios.get("https://cpoa.noahblanchard.fr/api/courts/1");
            let places = await axios.get("https://cpoa.noahblanchard.fr/api/places");
            let lesMatchs = []

            for (let reserv of response.data.reservations) {
                lesMatchs.push(reserv);


                // let split = response2.data.idMatch.split("/");
                // response2.data.idCourt = parseInt(response2.data.idCourt[response2.data.idCourt.length - 1]);
                // response2.data.idMatch = parseInt(split[3]);
                // reservations.push(response2.data)
            }
            lesMatchs = lesMatchs.filter(p => {
                return p.jour == id;

            })
            let tab = []
            if (lesMatchs.length > 0) {
                for (let match of lesMatchs) {
                    let joueur1 = await axios.get("https://cpoa.noahblanchard.fr/api/joueurs/" + match.idMatch.idJoueur1);
                    let joueur2 = await axios.get("https://cpoa.noahblanchard.fr/api/joueurs/" + match.idMatch.idJoueur2);

                    tab.push({
                        idR: match.idMatch.id,
                        nom1: joueur1.data.nom,
                        nom2: joueur2.data.nom
                    });
                }
                setJoueurs(tab);
            }

            setLesPlaces(places.data["hydra:member"]);
            setMatchs(lesMatchs);
            setChargement(false);

        } catch (ex) {
        }


    }

    const handleSubmit = (e) => {


        if (passConf == pass) {

            if (nom.length > 0 && prenom.length > 0 && email.length > 0 && pass.length > 0) {

                newBillet();

            }

        } else {
            alert("Veuillez confirmer le mot de passe entré auparavant !")
        }
    }


    const newBillet = async (r) => {
        try {

            let response;

            let idR = -1;

            if (place != -1 && tribune != -1 && selected != -1) {
                response = await axios.post("https://cpoa.noahblanchard.fr/api/reserv_places", {
                    rencontre: "api/rencontres/" + selected,
                    place: "api/places/" + place
                });
                idR = await response.data.id;
            }



            let idClient
            response = await axios.post("https://cpoa.noahblanchard.fr/api/clients", {
                nom: nom,
                telephone: tel,
                email: email,
                licence: promo,
                age: parseInt(age),
                prenom: prenom
            })
            idClient = await response.data.id;

            console.log({
                jour: parseInt(id),
                prix: prix,
                place: idR,
                client: "api/clients/" + idClient
            })

            response = await axios.post("https://cpoa.noahblanchard.fr/api/billets", {
                jour: parseInt(id),
                prix: prix,
                place: idR,
                client: "api/clients/" + idClient,
                email: email,
                code: pass
            });
            let idBillet = await response.data.id;

            navigate("/confirmation/" + idBillet);
        } catch (ex) {
            alert("Erreur")
        }
    }

    useEffect(() => {
        getMatchsPrincipal();


    }, [])


    const modalstyle = {
        position: 'absolute',
        top: '50%',
        left: '50%',
        transform: 'translate(-50%, -50%)',
        width: 500,
        backgroundColor: 'white',
        borderRadius: '10px',
        boxShadow: 24,
        padding: "2%"
    };

    const submitForm = (e) => {
        e.preventDefault();
        calcPrix();
        setValidate(!validate)

    }

    const calcPrix = async () => {
        let response;
        let cat = 2
        let p;
        if (place != -1) {
            response = await axios.get("https://cpoa.noahblanchard.fr/api/places/" + place);
            cat = response.data.cat;
        }

        if (cat == 2) {
            if (promo.length > 0) {
                if (parseInt(id) <= 3) {
                    p = 20
                } else if (parseInt(id) == 4) {
                    p = 25
                } else if (parseInt(id) == 5) {
                    p = 30
                } else if (parseInt(id) >= 6) {
                    p = 38
                }
            } else if (age <= 12) {
                if (parseInt(id) <= 3) {
                    p = 20
                } else if (parseInt(id) == 4) {
                    p = 25
                } else if (parseInt(id) == 5) {
                    p = 30
                } else if (parseInt(id) >= 6) {
                    p = 38
                }
            } else {
                if (parseInt(id) <= 3) {
                    p = 25
                } else if (parseInt(id) == 4) {
                    p = 30
                } else if (parseInt(id) == 5) {
                    p = 35
                } else if (parseInt(id) >= 6) {
                    p = 48
                }
            }
        } else {
            if (promo.length > 0) {
                if (parseInt(id) <= 3) {
                    p = 25
                } else if (parseInt(id) == 4) {
                    p = 35
                } else if (parseInt(id) == 5) {
                    p = 39
                } else if (parseInt(id) >= 6) {
                    p = 50
                }
            } else {
                if (parseInt(id) <= 3) {
                    p = 30
                } else if (parseInt(id) == 4) {
                    p = 40
                } else if (parseInt(id) == 5) {
                    p = 45
                } else if (parseInt(id) >= 6) {
                    p = 60
                }
            }
        }

        setCate(cat);

        setPrix(p);

    }

    return (



        <>


            <Modal
                open={open}
                onClose={() => setOpen(!open)}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box style={modalstyle}>
                    <Typography id="modal-modal-title" variant="h6" component="h2">
                        Catégorie 1
                    </Typography>
                    <ul>
                        <li>Tarif plein - Dimanche-Mardi 30€ / Mercredi 40€ / Jeudi 45€ / Vendredi-Samedi 60€ </li>
                        <li>Tarif licencié - Dimanche-Mardi 25€ / Mercredi 35€ / Jeudi 39€ / Vendredi-Samedi 50€ </li>
                    </ul>
                    <Typography id="modal-modal-title" variant="h6" component="h2">
                        Catégorie 2
                    </Typography>
                    <ul>
                        <li>Tarif enfants (-12) / Dimanche-Mardi 20€ / Mercredi 25€ / Jeudi 30€ / Vendredi-Samedi 38€ </li>
                        <li>Tarif plein - Dimanche-Mardi 25€ / Mercredi 30€ / Jeudi 35€ / Vendredi-Samedi 48€ </li>
                        <li>Tarif licencié - Dimanche-Mardi 20€ / Mercredi 25€ / Jeudi 30€ / Vendredi-Samedi 38€ </li>
                    </ul>
                </Box>
            </Modal>


            <div className={styles.reservPage + " page"}>
                {!validate ?
                    <form onSubmit={submitForm} className={styles.form}>
                        <div className={styles.wrapperForm}>

                            <Box sx={{ minWidth: 200 }}>

                                <h3>Choisissez un match du court central</h3>
                                <FormControl fullWidth>

                                    <InputLabel id="demo-simple-select-label">Match</InputLabel>
                                    <Select

                                        labelId="demo-simple-select-label"
                                        id="demo-simple-select"
                                        value={selected}
                                        label="Match"
                                        onChange={handleChange}
                                        helperText="Matchs du court principal uniquement"
                                    >
                                        <MenuItem key={-1} value={-1}>Ne pas réserver de place</MenuItem>
                                        {
                                            !chargement ?
                                                matchs.map((m) => {


                                                    let j = joueurs.find(je => {
                                                        return je.idR == m.idMatch.id;
                                                    })
                                                    return <MenuItem key={m.idMatch.id} value={m.idMatch.id}>{m.idMatch.id} - {j.nom1} contre {j.nom2 != "-1" ? j.nom2 : "Non Déterminé"} - {m.heure}:{m.minute}0</MenuItem>
                                                })
                                                :
                                                <MenuItem key={0} value={0}>Chargement...</MenuItem>
                                        }
                                    </Select>
                                </FormControl>

                                <FormControl fullWidth>
                                    <InputLabel id="demo-simple-select-label">Tribune</InputLabel>
                                    <Select
                                        labelId="demo-simple-select-label"
                                        id="demo-simple-select"
                                        value={tribune}
                                        label="Tribune"
                                        onChange={(e) => setTribune(e.target.value)}
                                        disabled={selected != "" && selected != -1 ? false : true}
                                    >
                                        <MenuItem value={-1}>Choix de la tribune</MenuItem>
                                        <MenuItem value={"Ouest"}>Tribune Ouest</MenuItem>
                                        <MenuItem value={"Nord"}>Tribune Nord</MenuItem>
                                        <MenuItem value={"Sud"}>Tribune Sud</MenuItem>
                                        <MenuItem value={"Est"}>Tribune Est</MenuItem>
                                    </Select>


                                </FormControl>
                                <FormControl fullWidth>
                                    <InputLabel id="demo-simple-select-label">Place</InputLabel>
                                    <Select
                                        labelId="demo-simple-select-label"
                                        id="demo-simple-select"
                                        value={place}
                                        label="Place"
                                        onChange={handleChangePlace}
                                        disabled={selected != "" && selected != -1 ? false : true}
                                    >

                                        <MenuItem value={-1}>Choix de la place</MenuItem>
                                        {
                                            tribune != -1 && mapPlace()
                                        }
                                    </Select>
                                </FormControl>

                                <h3>Code promo ou numéro de licence</h3>

                                <TextField
                                    size="small"
                                    id="outlined"
                                    helperText="Code promo ou numéro de licence"
                                    label="Code Promo"
                                    defaultValue=""
                                    value={promo}
                                    onChange={(e) => setPromo(e.target.value)}
                                />
                            </Box>
                            <Box sx={{ minWidth: 200 }}>
                                <h3>Entrez vos infos personnelles</h3>
                                <TextField
                                    required
                                    size="small"
                                    id="outlined-required"
                                    label="Nom"
                                    defaultValue=""
                                    error={!selected ? true : false}
                                    disabled={!selected ? true : false}
                                    value={nom}
                                    onChange={(e) => setNom(e.target.value)}
                                />
                                <TextField
                                    required
                                    size="small"
                                    id="outlined-required"
                                    label="Prenom"
                                    defaultValue=""
                                    value={prenom}
                                    onChange={(e) => setPrenom(e.target.value)}
                                    error={!selected ? true : false}

                                    disabled={!selected ? true : false}
                                />
                                <TextField
                                    size="small"
                                    id="outlined-number"
                                    label="Age"
                                    type="number"
                                    value={age}
                                    onChange={(e) => setAge(e.target.value)}
                                    InputLabelProps={{
                                        shrink: true,
                                    }}
                                />
                                <TextField
                                    size="small"
                                    required
                                    id="outlined-required"
                                    label="Email"
                                    type="email"
                                    value={email}
                                    onChange={(e) => setEmail(e.target.value)}
                                    error={!selected ? true : false}

                                    disabled={!selected ? true : false}
                                />
                                <TextField
                                    size="small"
                                    required
                                    id="outlined-required"
                                    label="Telephone"
                                    error={!selected ? true : false}
                                    disabled={!selected ? true : false}
                                    value={tel}
                                    onChange={(e) => setTel(e.target.value)}
                                />
                                <TextField
                                    size="small"
                                    required
                                    id="outlined-password-input"
                                    label="Code secret"
                                    type="password"
                                    defaultValue=""
                                    value={pass}
                                    onChange={(e) => setPass(e.target.value)}
                                    error={!selected ? true : false}

                                    disabled={!selected ? true : false}
                                    helperText="Pour retrouver votre réservation"
                                />
                            </Box>
                        </div>
                        <div className={styles.inlineDiv}>
                            <Button variant="outlined" onClick={() => navigate("/")}>Précédent</Button>
                            <Link style={{ cursor: "pointer" }} onClick={() => setOpen(!open)}>Informations tarifaires</Link>
                            <Button variant="contained" type="submit">Suivant</Button>
                        </div>
                    </form>
                    :
                    <>
                        <div className={styles.wrapperForm}>
                            <div className={styles.validateBox}>
                                <h3>Informations personnelles</h3>
                                <ul>
                                    <li>
                                        Nom : {nom}
                                    </li>
                                    <li>
                                        Prenom : {prenom}
                                    </li>
                                    <li>
                                        Age : {age}
                                    </li>
                                    <li>
                                        Email : {email}
                                    </li>
                                    <li>
                                        Téléphone : {tel}
                                    </li>
                                    <li>
                                        <TextField
                                            required
                                            id="outlined-password-input"
                                            label="Confirmez votre code secret"
                                            type="password"
                                            defaultValue=""
                                            value={passConf}
                                            onChange={(e) => setPassConf(e.target.value)}
                                        />
                                    </li>
                                </ul>
                            </div>
                            <div className={styles.validateBox}>
                                <h3>Infos du billets</h3>
                                <ul>
                                    {
                                        selected == -1 ?
                                            <li>Match : aucun match sélectionné</li>
                                            :
                                            <>
                                                <li>Match : {selectMatch.idJoueur1} contre {selectMatch.idJoueur2}</li>
                                                <li>Place : {place}</li>
                                            </>

                                    }
                                    <li>Categorie : {cate}</li>
                                    <li>Code promo ou licence : {promo.length > 0 ? "Oui" : "Non"}</li>
                                    <li>Prix : {prix}</li>
                                </ul>
                            </div>
                        </div>
                        <div className={styles.inlineDiv}>
                            <Button variant="outlined" onClick={() => setValidate(!validate)}>Précédent</Button>
                            <Link style={{ cursor: "pointer" }} onClick={() => setOpen(!open)}>Informations tarifaires</Link>
                            <Button variant="contained" onClick={handleSubmit}>Passer au paiement</Button>
                        </div>
                    </>

                }
            </div>

        </>
    )
}

export default Reserver
