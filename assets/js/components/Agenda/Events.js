import axios from "./Axios";
import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faRedo } from "@fortawesome/free-solid-svg-icons";
import dayjs from "dayjs";
import isBetween from "dayjs/plugin/isBetween";

const { useEffect } = wp.element;

function Events({
  isLoading,
  setIsLoading,
  dateFilter,
  dateFilterId,
  events,
  setEvents,
  filteredEvents,
  setFilteredEvents,
  isBetweenDate,
}) {
  const getEventsData = () => {
    setIsLoading(true);
    axios
      .get(`wp-json/ca/v1/events`)
      .then((res) => {
        setEvents(res.data);
        setFilteredEvents(res.data);
        console.log(res.data);
        setIsLoading(false);
      })
      .catch((err) => console.log(err.message));
  };

  useEffect(() => {
    getEventsData();
  }, []);

  //Filters Event
  useEffect(() => {
    if (dateFilterId !== undefined) {
      if (dateFilterId == 0) {
        setFilteredEvents(events);
      } else {
        //matches all event with starting MONTH date == dateFilterId
        let matchingEvents = events.filter((object) => {
          return object.month == dateFilterId;
        });

        //The selected category has a starting month value that is stored in isBetweenDate
        //The isBetweenDate is used to check if an event occurs between the starting and ending date
        //If true adds the event to an array that is merged with the first array

        dayjs.extend(isBetween); //extends isbetween function from dayjs

        let isBetweenEvents = events.filter((object) => {
          let startingDate = object.date_deb;
          startingDate = startingDate.split("/").reverse().join("-");
          let endingDate = object.date_fin;
          endingDate = endingDate.split("/").reverse().join("-");

          return dayjs(isBetweenDate).isBetween(
            startingDate,
            endingDate,
            null,
            []
          );
        });

        setFilteredEvents([...matchingEvents, ...isBetweenEvents]);
      }
    }
  }, [dateFilter, dateFilterId]);

  useEffect(() => {
    setEvents([1, 2, 3, 4, 5]);
  }, []);

  let classCarte1 =
    "1 object-card oc-event col-md-6 px-md-4px col-lg-4 px-lg-8px";
  let classCarte2_3 =
    "2 3 object-card oc-event pt-8px pt-md-0 col-md-6 px-md-4px col-lg-4 px-lg-8px";
  let classCarte456789 =
    "4 5 6 7 object-card oc-event pt-8px col-md-6 px-md-4px col-lg-4 pt-lg-16px px-lg-8px";

  if (isLoading == true) {
    return (
      <div style={{ marginTop: "5vh", fontSize: "15px", color: "#487F89" }}>
        <FontAwesomeIcon size="3x" spin={true} icon={faRedo} />
      </div>
    );
  } else {
    return (
      <>
        <ul className="pt-24px pt-md-32px d-md-flex flex-md-wrap mx-md-n4px mx-lg-n8px">
          {filteredEvents.map((object, index) => {
            return (
              <li
                key={`key ${index}`}
                className={
                  index == 0
                    ? classCarte1
                    : index == 2 || index == 1
                    ? classCarte2_3
                    : classCarte456789
                }
              >
                <a href="#" className="bg-img">
                  <i
                    className="bg-img-size-hover-110"
                    style={{
                      backgroundImage: `url(${object.images})`,
                      backgroundSize: "cover",
                    }}
                  >
                    <b className="d-block position-absolute top-0 bottom-0 left-0 right-0 bg-img-bgcolor-primary-0 bg-img-bgcolor-hover-primary-55 bg-img-transition-bgcolor"></b>
                    <span className="text-white shadow-text-sm m-auto bg-img-opacity-0 bg-img-opacity-hover-1 transition-opacity d-block align-self-center z-10 ff-semibold fs-short-2">
                      Voir l'événement
                    </span>
                  </i>
                  <div>
                    <div className="col-3">
                      <span>{object.day}</span>
                      <span>{object.month}</span>
                      <span>{object.year}</span>
                    </div>

                    <div className="col-9">
                      <h3 maxlenght="0">{object.nom}</h3>

                      <small>{object.localite}</small>

                      <small>{object.date_affichage}</small>
                    </div>
                  </div>
                </a>
              </li>
            );
          })}
        </ul>
      </>
    );
  }
}

export default Events;
