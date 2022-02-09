import TicketCard from './components/TicketCard/TicketCard';
import { BrowserRouter as Router, Route, Routes, Link, useNavigate } from 'react-router-dom';
import Landing from './pages/Landing/Landing';
import Reserver from './pages/Reserver/Reserver';
import Confirmation from './pages/Confirmation/Confirmation';
import Consulter from './pages/Consulter/Consulter';

import { useState } from 'react';

import Button from '@mui/material/Button';

import styles from './App.module.css';

function App() {

  return (
    <div className='App'>


      <nav className={styles.navBar}>
        <ul>
          <li className={styles.link}><Link to="/">Effectuer une réservation</Link></li>
          <li className={styles.link}><Link to="/consulter">Consulter une réservation</Link></li>
        </ul>
      </nav>

      <Routes>
        <Route exact path="/" element={<Landing />} />
        <Route exact path="/reserver/:id" element={<Reserver />} />
        <Route exact path="/confirmation/:id" element={<Confirmation />} />
        <Route exact path="/consulter" element={<Consulter />} />
      </Routes>

    </div>
  );
}

export default App;
