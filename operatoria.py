import pymysql
from datetime import date

# Conexión correcta usando argumentos nombrados
db = pymysql.connect(
    host="localhost",
    user="root",
    password="",
    database="php_login_database"
)

cursor = db.cursor()

# Obtener datos de la tabla pacientes
sql = "SELECT dosis, dosisindicada, fechareceta FROM pacientes"
cursor.execute(sql)
results = cursor.fetchall()

if results:
    sqldosis1 = [row[0] for row in results]
    sqldosisindicada1 = [row[1] for row in results]
    sqlfechareceta1 = [row[2] for row in results]

    db.close()

    # Cálculos
    quedamed = [round(sqldosis1[i] / sqldosisindicada1[i]) if sqldosisindicada1[i] > 0 else 0 for i in range(len(sqldosis1))]
    
    hoy = date.today()
    hoyyreceta = [hoy - n for n in sqlfechareceta1]
    diasint = [d.days for d in hoyyreceta]

    # Corrección de la variable 'dias' a 'diasint'
    calculo = [round(diasint[i] - quedamed[i]) for i in range(len(diasint))]
    print("Cálculo de días restantes:", calculo)

    # Reconectar para guardar el resultado (ejemplo con el primer valor o iterando)
    db = pymysql.connect(host="localhost", user="root", password="", database="php_login_database")
    cursor = db.cursor()
    
    # Asegúrate de que la tabla 'operatoria' exista en tu base de datos
    sql_insert = "INSERT INTO operatoria (op) VALUES (%s)"
    for val in calculo:
        cursor.execute(sql_insert, (val,))
    
    db.commit()
    db.close()
else:
    print("No hay pacientes registrados.")
    db.close()
