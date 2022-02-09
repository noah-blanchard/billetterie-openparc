import React from 'react'
import styles from './TicketCard.module.css'
import Button from '@mui/material/Button'

import Image from './assets/tennis.jpg';

import { useNavigate } from 'react-router-dom';

const TicketCard = ({day, title, reservable}) => {

    const nav = useNavigate();
    

    return (
        <div className={styles.ticketCard + " card"}>
            <img src={Image} />
            <p>Jour {day}</p>
            <p>{title}</p>
            <Button variant="contained" disabled={!reservable && true} onClick={() => nav("reserver/" + day)}>Réserver</Button>
        </div>
    )
}

export default TicketCard
