import React from 'react'
import styles from './Consulter.module.css';

import TextField from "@mui/material/TextField";
import Button from "@mui/material/Button";

import Loading from '../../components/Loading/Loading';

import axios from 'axios';

import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';


const Consulter = () => {

    const navigate = useNavigate();

    const [billet, setBillet] = useState(null);
    const [reserv, setReserv] = useState(null);
    const [place, setPlace] = useState(null);
    const [rencontre, setRencontre] = useState(null);
    const [email, setEmail] = useState('');
    const [pass, setPass] = useState("");
    const [found, setFound] = useState(false);
    const [error, setError] = useState(false);

    useEffect(() => {
        if (billet != null) {
            setFound(true);
            getReservPlace();
        } else {
            setFound(false);
            setReserv(null);
            setPlace(null);
            setRencontre(null);
        }
    }, [billet])

    const handleSubmit = (e) => {
        e.preventDefault()
        getBillet();

        // let thisBillet = billets.find(b => {
        //     return b.email == email && b.code == pass
        // });

        // console.log(thisBillet);
    }

    const getReservPlace = async () => {
        let response
        if (billet.place != -1) {
            try {
                response = await axios.get("https://cpoa.noahblanchard.fr/api/reserv_places/" + billet.place);
                let dataPlace = await response.data;
                setPlace(dataPlace.place);
                setRencontre(dataPlace.rencontre);
                response = await axios.get("https://cpoa.noahblanchard.fr/api/reservations/" + dataPlace.rencontre.reservations);
                let dataReservation = await response.data;
                setReserv(dataReservation);
            } catch (ex) {
                console.log(ex);
            }
        }
    }

    const getBillet = async () => {
        let response = await axios.get("https://cpoa.noahblanchard.fr/api/billets");
        let datas = await response.data;

        let bil = await datas["hydra:member"].find(b => {
            return b.email == email && b.code == pass
        });

        if (!bil) {
            setError(true);
            setBillet(null);
        } else {
            setError(false);
            setBillet(bil);
        }

    }


    return (
        <div className={styles.consultPage + " page"}>

            <div className={styles.formContainer}>
                {
                    !found ?
                        <form onSubmit={handleSubmit}>
                            <h3>Consulter une réservation</h3>
                            <TextField
                                required
                                id="outlined-required"
                                label="Email"
                                helperText="Email utilisé lors de l'achat du billet"
                                defaultValue=""
                                value={email}
                                error={error}
                                onChange={(e) => { setEmail(e.target.value); setError(false); }}
                            />
                            <TextField
                                id="outlined-password-input"
                                label="Code Secret"
                                type="password"
                                error={error}
                                helperText="Code secret utilisé lors de l'achat du bilelt"
                                autoComplete="current-password"
                                value={pass}
                                onChangeCapture={(e) => { setPass(e.target.value); setError(false); }}
                            />
                            <div className={styles.inlineDiv}>
                                <Button variant="outlined" onClick={() => navigate("/")}>Précédent</Button>
                                <Button type="submit" variant="contained">Confirmer</Button>
                            </div>
                        </form>
                        :
                        <div className={styles.results}>
                            {billet && rencontre && place && reserv ?
                                <>
                                    <h3>Réservation trouvée</h3>
                                    

                                    <div>
                                        <p>Nom : {billet.client.nom}</p>
                                        <p>Prénom : {billet.client.prenom}</p>
                                        <p>Email : {billet.client.email}</p>
                                        <p>Telephone : {billet.client.telephone}</p>
                                        <p>Match : {rencontre.id}</p>
                                        <p>Heure : {reserv.heure}:0{reserv.minute}</p>
                                    </div>

                                    <Button variant="outlined" onClick={() => setBillet(null)}>Précédent</Button>


                                    
                                </>
                                :
                                <Loading />
                            }
                        </div>
                }

            </div>

        </div>
    )
}

export default Consulter
