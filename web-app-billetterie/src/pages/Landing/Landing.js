import styles from './Landing.module.css';
import TicketCard from '../../components/TicketCard/TicketCard';

function Landing() {

  const tickets = [
    {
      day:1,
      title:"Samedi 14 mai 2022",
      reservable:false
    },
    {
      day:2,
      title:"Dimanche 15 mai 2022",
      reservable:true
    },
    {
      day:3,
      title:"Lundi 16 mai 2022",
      reservable:true
    },
    {
      day:4,
      title:"Mardi 17 mai 2022",
      reservable:true
    },
    {
      day:5,
      title:"Mercredi 18 mai 2022",
      reservable:false
    },
    {
      day:6,
      title:"Jeudi 19 mai 2022",
      reservable:false
    },
    {
      day:7,
      title:"Vendredi 20 mai 2022",
      reservable:false
    },
    {
      day:8,
      title:"Samedi 21 mai 2022",
      reservable:false
    }
  ]

  const DisplayTickets = () =>{
    return tickets.map(ticket => {
      return <TicketCard day={ticket.day} title={ticket.title} reservable={ticket.reservable}/>
    })
  }

  return (
    <>
    <div className={styles.landingPage + " page"}>
      <div className={styles.ticketDiv}>
        <DisplayTickets />
      </div>
    </div>
    </>
  )
}

export default Landing;
