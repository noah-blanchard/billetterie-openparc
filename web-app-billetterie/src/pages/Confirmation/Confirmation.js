import React from 'react'

import styles from './Confirmation.module.css';

import { AiOutlineCheckCircle as Check } from 'react-icons/ai';

import { useEffect, useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';

import Button from "@mui/material/Button"

const Confirmation = () => {

    const { id } = useParams();
    const navigate = useNavigate();

    return (
        <div className={styles.confirmPage + " page"}>
            <div className={styles.box}>
                <Check />
                <h1>Paiement Réussi !</h1>
                <div>
                    <p>Merci d'avoir acheté ce billet !</p>
                    <p>Nous espérons vous voir lors de l'Open Parc au mois de mai.</p>
                    <p>En attendant, vous pouvez accéder à votre billet en utilisant l'email et le code secret utilisé lors de la réservation.</p>
                </div>
                <div className={styles.buttonWrapper}>
                    <Button onClick={() => navigate("/")} variant="contained">Accueil</Button>
                </div>
            </div>

        </div>
    )
}

export default Confirmation
