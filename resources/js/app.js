import "./bootstrap";

import Alpine from "alpinejs";

import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

window.FullCalendar = { Calendar, dayGridPlugin, interactionPlugin };

window.Alpine = Alpine;

Alpine.start();
