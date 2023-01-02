# Trainings API

For use this API:

- GET    /participants
- GET    /participants/:id
- POST   /participants
    - firstname (string)
    - lastname (string)
    - company (string + NULL)
- GET    /formations
- POST   /formations
    - name (string)
    - begindate (date)
    - enddate (date)
    - maxparticipants (integer)
    - price (integer)